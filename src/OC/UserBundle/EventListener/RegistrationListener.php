<?php
/**
 * Created by PhpStorm.
 * User: AMIN
 * Date: 2/9/2018
 * Time: 1:33 PM
 */

namespace OC\UserBundle\EventListener;


use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\UserEvent;

class RegistrationListener implements EventSubscriberInterface
{
    private $router;

    public function __construct()
    {
    }

    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::REGISTRATION_INITIALIZE => 'addRoleUser'
        );
    }

    public function addRoleUser(UserEvent $event){
        $event->getUser()->setRoles(array('ROLE_AUTEUR'));
    }


}