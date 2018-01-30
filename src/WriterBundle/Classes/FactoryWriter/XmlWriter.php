<?php
/**
 * Created by PhpStorm.
 * User: AMIN
 * Date: 1/24/2018
 * Time: 12:23 PM
 */

namespace WriterBundle\Classes\FactoryWriter;


use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use WriterBundle\Classes\FactoryType\AbstractType;

class XmlWriter extends DataWriter
{
    public $urlFile;

    public function write(Array $data){
        //write data in csv
        $mainNode = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" standalone="yes"?><mydoc></mydoc>');
        foreach ($data as $key => $value){
            $mainNode->addChild($key,$value);
        }
        return $mainNode;
    }

    public function writeSimple(Array $data){
        //write data in csv
        return $this->write($data)->asXML();
    }

    function writeFile(AbstractType $instance)
    {

        // save csv file system
        $mainNode = $this->write($instance);
        $my_file = '/file.xml';
        $folder= UrlGeneratorInterface::ABSOLUTE_URL. "/Resource/xml";



        // save csv file system


        if(!is_dir($folder)){
            $fs = new Filesystem();
            $folder = $fs->mkdir($folder,777);;
        }
        $handle = fopen($folder.$my_file, 'w+') or die('Cannot open file:  '.$my_file);
        $mainNode->asXML($folder.$my_file);
        fclose($handle);

    }


}