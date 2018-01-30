<?php
/**
 * Created by PhpStorm.
 * User: AMIN
 * Date: 1/23/2018
 * Time: 5:19 PM
 */

namespace MailerBundle\Classes;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

class ClientMailer extends MailFormatter
{
    private $event_date;

    public function __construct($parameters,  EngineInterface $engine)
    {
        parent::__construct($parameters, $engine);
        $this->event_date = $this->parameters['event_date'];
    }


    /**
     * @return mixed
     */
    public function getEventDate()
    {
        return $this->event_date;
    }

    /**
     * @param mixed $event_date
     */
    public function setEventDate($event_date)
    {
        $this->event_date = $event_date;
    }



    public function getTemplate(){
        return 'MailerBundle:Default:email.html.twig';
    }



    public function getTemplateData(){
        return array_merge(parent::getTemplateData(),
                array(
                        "event_date"=>$this->getEventDate()
                    ));

    }







}