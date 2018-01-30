<?php
/**
 * Created by PhpStorm.
 * User: AMIN
 * Date: 1/29/2018
 * Time: 6:51 PM
 */

namespace OC\PlatformBundle\Email;

use OC\PlatformBundle\Entity\Application;

class ApplicationEmailer
{
    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendNewNotification(Application $application){
       $message = new \Swift_Message(
           'Nouvelle candidature',
           'Vous avez reçu une nouvelle candidature.');
       $message->addTo('zirazizou@gmail.com');
       $message->addFrom('zmouhamedamin@gmail.com');
       $this->mailer->send($message);
    }
}