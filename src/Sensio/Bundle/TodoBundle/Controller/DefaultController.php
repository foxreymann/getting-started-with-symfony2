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
        

        return array();
    }
}
