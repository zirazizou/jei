<?php

namespace BridgeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('BridgeBundle:Default:index.html.twig');
    }
}
