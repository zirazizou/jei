<?php
/**
 * Created by PhpStorm.
 * User: AMIN
 * Date: 1/23/2018
 * Time: 5:01 PM
 */

namespace MailerBundle\Classes;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

abstract class MailFormatter
{

    protected $object;
    protected $body;
    protected $parameters;
    protected $email;
    protected $template;
    protected $engine;


    public function __construct($parameters,  EngineInterface $engine)
    {
        $this->parameters = $parameters;

        if(isset($this->parameters['object'])){
            $this->setObject( $this->parameters['object']);
        }
        if(isset($this->parameters['body'])){
            $this->setBody( $this->parameters['body']);
        }

        $this->engine = $engine;
    }


    public function render($template, $data){

        return $this->getEngine()->render(
            $this->getTemplate(),
            array('data'=>$this->getTemplateData())

        );
    }

    /**
     * @return mixed
     */
    public function getEngine()
    {
        return $this->engine;
    }

    /**
     * @param mixed $engine
     */
    public function setEngine($engine)
    {
        $this->engine = $engine;
    }

    public function buildBody(){

        $template = $this->getTemplate();
        $data = $this->getTemplateData();
        $rendered = $this->render($template, $data);
        return $rendered;
    }

    public function setObject($object)
    {
        $this->object = $object;
    }

    public function getObject()
    {
        return $this->object;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param array $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }



    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getTemplateData()
    {
        return array(
            "object"=>$this->getObject(),
            "body"=>$this->getBody(),
            "email"=>$this->getEmail()
        );
    }


    public function getTemplate(){
        return "MailerBundle:Default:index.html.twig";
    }


}