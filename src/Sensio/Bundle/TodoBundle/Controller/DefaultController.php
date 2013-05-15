<?php

namespace Sensio\Bundle\TodoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="todo_list")
     * @Template()
     */
    public function indexAction()
    {
        // Opening DB connection
        if (!$conn = mysql_connect('127.0.0.1', 'root', '')) {
            die('Unable to connect to MySQL : '. mysql_errno() .' '. mysql_error());
        }

        mysql_select_db('training_todo', $conn) or die('Unable to select database "training_todo"');
        
        // Counting number of tasks in db
        $result = mysql_query('SELECT COUNT(*) FROM todo', $conn);
        $count  = current(mysql_fetch_row($result));

        // Retrive all tasks in DB
        $tasks = array();
        $result = mysql_query('SELECT * FROM todo', $conn);

        while ($todo = mysql_fetch_assoc($result)) {
            $tasks[] = $todo;
        }

        mysql_close($conn);

        return array('count' => $count, 'tasks' => $tasks);
    }

    /**
     * @Route("/{id}/show", name="todo_show", requirements={"id" : "\d+"}) 
     * @Template()
     */
    public function showAction($id) 
    {
        // Opening DB connection
        if (!$conn = mysql_connect('127.0.0.1', 'root', '')) {
            die('Unable to connect to MySQL : '. mysql_errno() .' '. mysql_error());
        }

        mysql_select_db('training_todo', $conn) or die('Unable to select database "training_todo"');
        
        // Retrive the task from db 
        $result = mysql_query('SELECT * FROM todo WHERE id = '. $id);
        $todo = mysql_fetch_assoc($result);

        mysql_close($conn);

        // forward to 404 if task not found
        if(!$todo) {
            throw new NotFoundHttpException(sprintf('Task #%d not found', $id));
        }        

    
        // pass to twig
        return array('todo' => $todo);

    }

}
