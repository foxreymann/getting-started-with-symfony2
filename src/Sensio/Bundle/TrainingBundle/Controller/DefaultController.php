<?php

namespace Sensio\Bundle\TrainingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Cookie;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}", name="greet" )
     */
    public function helloAction($name)
    {
        $cookie = new Cookie('username', $name, new \DateTime('+30 days'));

        $response = $this->redirect($this->generateUrl('hello'));
        $response->headers->setCookie($cookie);

        return $response;
    }

    /**
     * @Route("/hello", name="hello" )
     * @Template()
     */
    public function indexAction(Request $request)
    {
        if (!$name = $request->cookies->get('username')) {
            throw $this->createNotFoundException('No username found'); 
        }

        return array('name' => $name);


    }     


}
