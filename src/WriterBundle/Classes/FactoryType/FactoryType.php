<?php
/**
 * Created by PhpStorm.
 * User: AMIN
 * Date: 1/24/2018
 * Time: 2:18 PM
 */

namespace WriterBundle\Classes\FactoryType;


class FactoryType
{
    public static function getInstance($type, $parameters, $writer){
        //return instance of target if class existe

        $className  = __NAMESPACE__."\\".ucfirst($type."Type");
        if (class_exists($className)) {
            return new $className($parameters[$type], $writer);
        }

    }
}