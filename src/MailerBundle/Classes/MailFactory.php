<?php
/**
 * Created by PhpStorm.
 * User: AMIN
 * Date: 1/23/2018
 * Time: 5:03 PM
 */

namespace MailerBundle\Classes;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

class MailFactory
{


    public static function getInstance($target, $parameters, EngineInterface $engine){
        switch($target){
            case 'client':
                return new ClientMailer($parameters['client'], $engine);
                break;
            case 'fournisseur':
                return new FournisseurMailer($parameters['fournisseur'], $engine);
                break;
            default:
                return false;
                break;
        }
    }

}