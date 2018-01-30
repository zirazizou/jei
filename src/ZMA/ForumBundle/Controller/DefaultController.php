<?php

namespace ZMA\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ZMAForumBundle:Default:index.html.twig');
    }
}
