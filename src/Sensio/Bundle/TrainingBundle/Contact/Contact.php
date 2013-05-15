<?php

namespace Sensio\Bundle\TrainingBundle\Contact;

use Symfony\Component\Validator\Constraints as Assert;

class Contact
{
    /** 
      * @Assert\NotBlank()
      * @Assert\Email()
      */
    public $sender;

    /** 
      * @Assert\NotBlank()
      * @Assert\Length(min=10, max=50)
      */
    public $subject;

    /** 
      * @Assert\NotBlank()
      */
    public $message;

}
