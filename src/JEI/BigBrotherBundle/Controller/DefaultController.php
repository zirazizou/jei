<?php

namespace JEI\BigBrotherBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('JEIBigBrotherBundle:Default:index.html.twig');
    }
}
