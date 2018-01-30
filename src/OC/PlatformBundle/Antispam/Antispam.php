<?php
/**
 * Created by PhpStorm.
 * User: AMIN
 * Date: 1/26/2018
 * Time: 5:04 PM
 */

namespace OC\PlatformBundle\Antispam;


class Antispam
{
    private $mailer;
    private $locale;
    private $length;

    public function __construct(\Swift_Mailer $mailer, $locale, $length)
    {
        $this->mailer = $mailer;
        $this->locale = $locale;
        $this->length = (int) $length;
    }

    public function isSpam($text){
        return strlen($text) < $this->length;
    }
}