<?php

namespace Sensio\Bundle\TrainingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\TrainingBundle\Contact\Contact;
use Sensio\Bundle\TrainingBundle\Contact\ContactType;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller
{
    /**
     * @Route("/contact", name = "contact")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $contact = new Contact();
        $form = $this->createForm(new ContactType(), $contact);

        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                $contact->send('tomasz.jureczko@gmail.com');
    
                $url = $this->generateUrl('success');

                return $this->redirect($url); 
            }
        }

        return array('form' => $form->createView());
    }

    /**
     * @Route("/contact/success", name = "success")
     * @Template()
     */
    public function successAction()
    {
        return array();
    }

}
