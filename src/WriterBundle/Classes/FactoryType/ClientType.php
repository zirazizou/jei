<?php
/**
 * Created by PhpStorm.
 * User: AMIN
 * Date: 1/24/2018
 * Time: 2:37 PM
 */

namespace WriterBundle\Classes\FactoryType;


use WriterBundle\Classes\FactoryWriter\DataWriter;

class ClientType extends AbstractType
{

    public $eventDate;

    /**
     * ClientType constructor.
     * @param $parameters
     * @param DataWriter $writer
     */
    public function __construct($parameters, $writer)
    {
        parent::__construct($parameters, $writer);
        $this->type = "client";
        if(isset($this->parameters['event_date'])){
            $this->eventDate = $this->parameters['event_date'];
        }

    }
    /**
     * @return mixed
     */
    public function getEventDate()
    {
        return $this->eventDate;
    }

    /**
     * @param mixed $eventDate
     */
    public function setEventDate($eventDate)
    {
        $this->eventDate = $eventDate;
    }

    public function getData(){
        return array_merge(
            parent::getData(),array("event_data"=> $this->getEventDate())
        );
    }






}