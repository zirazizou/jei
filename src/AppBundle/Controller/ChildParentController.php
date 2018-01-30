<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\ChildParent;
use Symfony\Component\HttpFoundation\Request;

class ChildParentController extends Controller
{
    /**
     * @Route("/parents", name="parent_list")
     * @Method({"get"})
     */
    public function getChildParentsAction(Request $request) {
        $parent1 = new ChildParent("amin", "ziraoui","developpeur","20311313");
        $parent2 =  new ChildParent("akram","kamoun","doctorant","52319666");
        $parent3 = new ChildParent("ghassen", "khalil","entrepreneur","52948948");
        $parents  = [
            $parent1->getNom()
            ,$parent2->getNom()
           ,$parent3->getNom()

        ];
        return new JsonResponse($parents);
    }

    public function getChildParent(){

    }
}