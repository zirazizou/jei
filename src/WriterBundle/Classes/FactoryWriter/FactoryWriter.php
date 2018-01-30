<?php
/**
 * Created by PhpStorm.
 * User: AMIN
 * Date: 1/24/2018
 * Time: 3:22 PM
 */

namespace WriterBundle\Classes\FactoryWriter;


class FactoryWriter
{
    //function for generating instance of writer dynamically

    public static function getInstance($extension){
        $extension = ucfirst($extension);

        $className  =  __NAMESPACE__."\\".$extension."Writer";
        //check if function writer exist
        if (class_exists($className)) {
            //return generated writer instance
            return new $className();
        }
    }

}