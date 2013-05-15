<?php

namespace Sensio\Bundle\TodoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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
}
