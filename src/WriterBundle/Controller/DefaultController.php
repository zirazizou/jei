<?php

namespace WriterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('WriterBundle:Default:index.html.twig');
    }
}
