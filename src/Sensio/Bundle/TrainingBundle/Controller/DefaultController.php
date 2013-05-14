<?php

namespace Sensio\Bundle\TrainingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}", name="greet" )
     */
    public function helloAction(Request $request, $name)
    {
        $session = $request->getSession();
        $session->set('username', $name);

        $response = $this->redirect($this->generateUrl('hello'));

        return $response;
    }

    /**
     * @Route("/hello", name="hello" )
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        if (!$name = $session->get('username')) {
            throw $this->createNotFoundException('No username found'); 
        }

        return array('name' => $name);
    }     


}
