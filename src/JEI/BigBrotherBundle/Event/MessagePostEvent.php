<?php
/**
 * Created by PhpStorm.
 * User: AMIN
 * Date: 2/10/2018
 * Time: 1:29 PM
 */

namespace JEI\BigBrotherBundle\Event;



use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\Security\Core\User\UserInterface;

class MessagePostEvent extends Event
{
    protected $message;
    protected $user;

    public function __construct($message, UserInterface $user){
        $this->message = $message;
        $this->user = $user;
    }

    public function getMessage(){
        return $this->message;
    }

    public function setMessage($message){
        return $this->message = $message;
    }

    /**
     * @return UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }

}