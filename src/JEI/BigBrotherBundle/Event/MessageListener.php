<?php
/**
 * Created by PhpStorm.
 * User: AMIN
 * Date: 2/10/2018
 * Time: 4:10 PM
 */

namespace JEI\BigBrotherBundle\Event;


use JEI\BigBrotherBundle\Service\MessageNotificator;

class MessageListener
{
    protected $notificator;
    protected $listUsers = array();

    public function __construct(MessageNotificator $notificator, $listUsers)
    {
        $this->notificator = $notificator;
        $this->listUsers = $listUsers;
    }

    public function processMessage(MessagePostEvent $event){
        if(in_array($event->getUser()->getUsername(), $this->listUsers)){
            $event->setMessage("added from MessageListener: ".$event->getMessage());
            $this->notificator->notifiByEmail($event->getMessage(), $event->getUser());

        }
    }

}