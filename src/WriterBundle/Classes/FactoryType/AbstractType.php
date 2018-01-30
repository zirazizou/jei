<?php
/**
 * Created by PhpStorm.
 * User: AMIN
 * Date: 1/24/2018
 * Time: 2:37 PM
 */

namespace WriterBundle\Classes\FactoryType;


abstract class AbstractType
{
    protected $object;
    protected $body;
    protected $parameters;
    protected $urlFile;
    protected $type;
    protected $writer;

    public function __construct($parameters, $writer)
    {
        //init parameters, variable object body
        $this->parameters = $parameters;
        $this->writer = $writer;
        if(isset($this->parameters['object'])){
            $this->setObject( $this->parameters['object']);
        }
        if(isset($this->parameters['body'])){
            $this->setBody( $this->parameters['body']);
        }

    }


    public function setObject($object)
    {
        $this->object = $object;
    }

    public function write(){
        return $this->getWriter()->write($this->getData());
    }

    public function writeSimple(){
        return $this->getWriter()->writeSimple($this->getData());
    }

    public function writeFile(){
        return $this->getWriter()->writeFile($this->getData());
    }

    public function getObject()
    {
        return $this->object;
    }

    public function getData(){
        return array(
            "object"=> getObject(),
            "body"=> getBody()
        );
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
     * @return DataWriter
     */
    public function getWriter()
    {
        return $this->writer;
    }

    /**
     * @param DataWriter $writer
     */
    public function setWriter($writer)
    {
        $this->writer = $writer;
    }



    /**
     * @return mixed
     */
    public function getUrlFile()
    {
        return $this->urlFile;
    }

    /**
     * @param mixed $urlFile
     */
    public function setUrlFile($urlFile)
    {
        $this->urlFile = $urlFile;
    }

    /**
     * @return mixed
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param mixed $parameters
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
    }




}