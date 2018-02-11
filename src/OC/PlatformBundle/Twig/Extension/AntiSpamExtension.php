<?php

namespace OC\PlatformBundle\Twig\Extension;

use OC\PlatformBundle\Antispam\Antispam;

class AntiSpamExtension extends \Twig_Extension
{
    /**
     * {@inheritdoc}
     */
    private $ocAntispam;

    public function __construct(Antispam $ocAntispam)
    {
        $this->ocAntispam = $ocAntispam;
    }

    public function checkIfArgumentIsSpam($text){
        return $this->ocAntispam->isSpam($text);
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('checkIfSpam', array($this, 'checkIfArgumentIsSpam'))
        );
    }

    public function getName()
    {
        return 'OCAntispam';
    }
}
