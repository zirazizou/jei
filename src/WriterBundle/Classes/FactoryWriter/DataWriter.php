<?php
/**
 * Created by PhpStorm.
 * User: AMIN
 * Date: 1/24/2018
 * Time: 12:21 PM
 */

namespace WriterBundle\Classes\FactoryWriter;



use WriterBundle\Classes\FactoryType\AbstractType;
use WriterBundle\Classes\FactoryType\interfaceWriter;

abstract class DataWriter
{
    public $instanceType;

    abstract function write(Array $data);
    abstract function writeFile(Array $data);

}