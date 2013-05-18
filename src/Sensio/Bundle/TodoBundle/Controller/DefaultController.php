<?php

namespace Sensio\Bundle\TodoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\TodoBundle\Model\TaskTable;
use Sensio\Bundle\TodoBundle\Model\Task;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="todo_list")
     * @Template()
     */
    public function indexAction()
    {
        $table = new TaskTable($this->getDatabaseConnection());

        return array(
            'count' => $table->countAll(),
            'tasks' => $table->findAll()
        );
    }

    /**
     * @Route("/{id}/show", name="todo_show", requirements={"id" : "\d+"}) 
     * @Template()
     */
    public function showAction($id) 
    {
        $table = new TaskTable($this->getDatabaseConnection());
   
        $todo = $table->find($id);

        if(!$todo) {
            throw new NotFoundHttpException(sprintf('Task #%d not found', $id));
        }
 
        // pass to twig
        return array('todo' => $todo);
    }

    /**
     * @Route("/create", name="todo_create")
     */
    public function createAction(Request $request) 
    {
        $task = new Task();
        $task->title = $request->request->get('title');
        $task->save($this->getDatabaseConnection());
        
        // redirect to tasks list
        return $this->redirect($this->generateUrl('todo_list')); 
    }
    
    /**
     * @Route("/{id}/close", name="todo_close", requirements={"id" : "\d+"}) 
     */
    public function closeAction($id) 
    {
        $conn = $this->getDatabaseConnection();

        $query = 'UPDATE todo SET is_done = 1 WHERE id = '. mysql_real_escape_string($id);
        mysql_query($query, $conn) or die('Unable to update existing task : '. mysql_error());

        mysql_close($conn);

        // redirect to tasks list
        return $this->redirect($this->generateUrl('todo_list')); 
    }

    /**
     * @Route("/{id}/delete", name="todo_delete", requirements={"id" : "\d+"}) 
     */
    public function deleteAction($id) 
    {
        $conn = $this->getDatabaseConnection();

        $query = 'DELETE FROM todo WHERE id = '. mysql_real_escape_string($id);
        mysql_query($query, $conn) or die('Unable to update existing task : '. mysql_error());

        mysql_close($conn);

        // redirect to tasks list
        return $this->redirect($this->generateUrl('todo_list')); 
    }

    private function getDatabaseConnection() {
        return $this->container->get('sensio.db');
    }

}
