<?php

// src/OC/PlatformBundle/Controller/AdvertController.php

namespace OC\PlatformBundle\Controller;

use OC\PlatformBundle\Entity\Advert;
use OC\PlatformBundle\Entity\AdvertSkill;
use OC\PlatformBundle\Entity\Application;
use OC\PlatformBundle\Entity\Image;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdvertController extends Controller
{
    public function indexAction($page)
    {
        // On ne sait pas combien de pages il y a
        // Mais on sait qu'une page doit être supérieure ou égale à 1


        if ($page < 1) {
            // On déclenche une exception NotFoundHttpException, cela va afficher
            // une page d'erreur 404 (qu'on pourra personnaliser plus tard d'ailleurs)
            throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
        }

        // Ici, on récupérera la liste des annonces, puis on la passera au template

        // Mais pour l'instant, on ne fait qu'appeler le template

        $em = $this->getDoctrine()->getManager();
        $listAdverts = $em->getRepository('OCPlatformBundle:Advert')->findAll();

        // Et modifiez le 2nd argument pour injecter notre liste
        return $this->render('OCPlatformBundle:Advert:index.html.twig', array(
            'listAdverts' => $listAdverts
        ));
    }

    public function viewAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $advert = $em->getRepository('OCPlatformBundle:Advert')
            ->find($id);

        if (null === $advert) {
            throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
        }

        $listApplications = $em
            ->getRepository("OCPlatformBundle:Application")
            ->findBy(array('advert'=>$id));

        $listAdvertSkill = $em
            ->getRepository("OCPlatformBundle:AdvertSkill")
            ->findBy(array('advert'=>$id));

        return $this->render('OCPlatformBundle:Advert:view.html.twig', array(
            'advert' => $advert,
            'listApplications'=> $listApplications,
            'listAdvertSkill'=>$listAdvertSkill
        ));
    }

    public function menuAction()
    {
        // On fixe en dur une liste ici, bien entendu par la suite
        // on la récupérera depuis la BDD !
        $listAdverts = array(
            array('id' => 2, 'title' => 'Recherche développeur Symfony'),
            array('id' => 5, 'title' => 'Mission de webmaster'),
            array('id' => 9, 'title' => 'Offre de stage webdesigner')
        );

        return $this->render('OCPlatformBundle:Advert:menu.html.twig', array(
            // Tout l'intérêt est ici : le contrôleur passe
            // les variables nécessaires au template !
            'listAdverts' => $listAdverts
        ));
    }
    public function addAction(Request $request)
    {
        // La gestion d'un formulaire est particulière, mais l'idée est la suivante :

        // Si la requête est en POST, c'est que le visiteur a soumis le formulaire
        if ($request->isMethod('POST')) {
            // Ici, on s'occupera de la création et de la gestion du formulaire

            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

            // Puis on redirige vers la page de visualisation de cettte annonce
            return $this->redirectToRoute('oc_platform_view', array('id' => 5));
        }
        $em = $this->getDoctrine()->getManager();
//        $listAdverts = array(
//            array(
//                'title'   => 'Recherche développpeur Symfony',
//                'author'  => 'Alexandre',
//                'content' => 'Nous recherchons un développeur Symfony débutant sur Lyon. Blabla…',
//                'date'    => new \Datetime()),
//            array(
//                'title'   => 'Mission de webmaster',
//                'author'  => 'Hugo',
//                'content' => 'Nous recherchons un webmaster capable de maintenir notre site internet. Blabla…',
//                'date'    => new \Datetime()),
//            array(
//                'title'   => 'Offre de stage webdesigner',
//                'author'  => 'Mathieu',
//                'content' => 'Nous proposons un poste pour webdesigner. Blabla…',
//                'date'    => new \Datetime())
//        );
//        $em = $this->getDoctrine()->getManager();
//
//        foreach($listAdverts as $array){
//            $advert = new Advert();
//            $advert->setTitre($array['title']);
//            $advert->setContent($array['content']);
//            $advert->setDate($array['date']);
//            $advert->setPublished(true);
//            $advert->setAuthor($array['author']);
//            $em->persist($advert);
//        }
//        $em->flush();
        // Si on n'est pas en POST, alors on affiche le formulaire

        $advert = new Advert();
        $advert->setTitre("Annonce developper doctrine events 2 ");
        $advert->setContent("Nous recherchons un développeur Angular 4 débutant sur Lyon.");
        $advert->setAuthor("Alexandre");
        $advert->setPublished(true);

        $allSkills = $em->getRepository("OCPlatformBundle:Skill")->findAll();

        $image = new Image();
        $image->setUrl("https://cdn.worldvectorlogo.com/logos/angular-3.svg");
        $image->setAlt("angular 4");
        $advert->setImage($image);

        foreach ($allSkills as $skill){
            $advertSkill = new AdvertSkill();
            $advertSkill->setAdvert($advert);
            $advertSkill->setSkill($skill);
            $advertSkill->setLevel("Expert");
            $em->persist($advertSkill);
        }

        $categories = $this->getDoctrine()
            ->getManager()
            ->getRepository("OCPlatformBundle:Category")
            ->findAll();

        foreach ($categories as $category){
            $advert->addCategory($category);
        }



        $application1 = new Application();
        $application1->setAuthor('Marine');
        $application1->setContent("J'ai toutes les qualités requises. j'ai les capacitees necessaire.");

        // Création d'une deuxième candidature par exemple
        $application2 = new Application();
        $application2->setAuthor('Pierre');
        $application2->setContent("Je suis très motivé.");

        $application1->setAdvert($advert);
        $application2->setAdvert($advert);
        $em->persist($application1);
        $em->persist($image);
        $em->persist($application2);
        $em->persist($advert);
        $em->flush();

        return $this->render('OCPlatformBundle:Advert:add.html.twig');
    }

    public function editAction($id, Request $request)
    {
        // Ici, on récupérera l'annonce correspondante à $id

        // Même mécanisme que pour l'ajout
        if ($request->isMethod('POST')) {
            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.');

            return $this->redirectToRoute('oc_platform_view', array('id' => 5));
        }

        return $this->render('OCPlatformBundle:Advert:edit.html.twig');
    }

    public function deleteAction($id)
    {
        // Ici, on récupérera l'annonce correspondant à $id

        // Ici, on gérera la suppression de l'annonce en question

        return $this->render('OCPlatformBundle:Advert:delete.html.twig');
    }
}