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

    /**
     * @Assert\True(message="Subject and message must differ")
     */
    public function isSubjectAndMessageValid()
    {
        return $this->subject !== $this->message;
    }

    public function send($recipient)
    {
        $headers = array();
        $headers[] = sprintf('From: %s', $this->sender);
        $headers[] = sprintf('Reply-To: %s',  $this->sender);

        mail(
            $recipient,
            $this->subject,
            $this->message,
            implode("\r\n", $headers)
        );
    }

}
