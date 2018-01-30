<?php
/**
 * Created by PhpStorm.
 * User: AMIN
 * Date: 1/23/2018
 * Time: 6:02 PM
 */

namespace MailerBundle\Classes;

class MailerSender
{
    private $mailer;

    public function __construct(\Swift_Mailer  $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendEmail(MailFormatter $instance){

        $message = \Swift_Message::newInstance($instance->getObject())
            ->setContentType("text/html")
            ->setFrom('zmouhamedamin@gmail.com')
            ->setTo($instance->getEmail());
        $message->setBody($instance->buildBody());
        if ($this->mailer->send($message))
        {
            return true;
        }
        return false;
    }
}