<?php
/**
 * Created by PhpStorm.
 * User: AMIN
 * Date: 1/29/2018
 * Time: 10:09 PM
 */

namespace OC\PlatformBundle\DoctrineListener;


use Doctrine\ORM\Event\LifecycleEventArgs;
use OC\PlatformBundle\Email\ApplicationEmailer;
use OC\PlatformBundle\Entity\Application;

class ApplicationCreationListener
{
    private $applicationEmailer;

    public function __construct(ApplicationEmailer $applicationEmailer)
    {
        $this->applicationEmailer = $applicationEmailer;

    }

    public function postPersist(LifecycleEventArgs $arg){

        $object = $arg->getObject();

        if(!$object instanceof Application){
            return ;
        }
        try{
            $this->applicationEmailer->sendNewNotification($object);
        }catch (\Exception $e){
            
        }


    }


}