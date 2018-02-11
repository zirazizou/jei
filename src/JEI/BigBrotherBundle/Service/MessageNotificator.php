<?php
/**
 * Created by PhpStorm.
 * User: AMIN
 * Date: 2/10/2018
 * Time: 3:40 PM
 */

namespace JEI\BigBrotherBundle\Service;


use Symfony\Component\Security\Core\User\UserInterface;

class MessageNotificator
{
    protected $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function notifiByEmail($message, UserInterface $user){
        $message = \Swift_Message::newInstance()
            ->setSubject("Nouveau message d'un utilisateur surveille")
            ->setFrom("zmouhamedamin@gmail.com")
            ->setTo("zirazizou@gmail.com")
            ->setBody("L' utilisateur surveille '".$user->getUsername()."' a poste le message suivant");
        $this->mailer->send($message);
    }



}