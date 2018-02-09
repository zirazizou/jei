<?php

// src/OC/PlatformBundle/Controller/AdvertController.php

namespace OC\PlatformBundle\Controller;

use OC\PlatformBundle\Entity\Advert;
use OC\PlatformBundle\Entity\AdvertSkill;
use OC\PlatformBundle\Entity\Application;
use OC\PlatformBundle\Entity\Image;
use OC\PlatformBundle\Form\AdvertEditType;
use OC\PlatformBundle\Form\AdvertType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilder;
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
        $listAdverts = $em->getRepository('OCPlatformBundle:Advert')
                          ->getAdverts($page, $this->getParameter('nbPerPageIndex'));
        $pages = (int) round($listAdverts->count() / $this->getParameter('nbPerPageIndex'));

        // Et modifiez le 2nd argument pour injecter notre liste
        return $this->render('OCPlatformBundle:Advert:index.html.twig', array(
            'listAdverts' => $listAdverts,
            'nbPerPage' => $this->getParameter('nbPerPageIndex'),
            'pages' => $pages,
            'currentPage'=> $page
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

    public function menuAction($limits)
    {
        // On fixe en dur une liste ici, bien entendu par la suite
        // on la récupérera depuis la BDD !

        $em = $this->getDoctrine()->getManager();

        $listAdverts = $em->getRepository("OCPlatformBundle:Advert")
            ->findBy(
                array(),
                array('date'=>'desc'),
                $limits,
                0
            );
        return $this->render('OCPlatformBundle:Advert:menu.html.twig', array(
            // Tout l'intérêt est ici : le contrôleur passe
            // les variables nécessaires au template !
            'listAdverts' => $listAdverts
        ));
    }


    /**
     * @Security("has_role('ROLE_AUTEUR')")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        // La gestion d'un formulaire est particulière, mais l'idée est la suivante :

        // Si la requête est en POST, c'est que le visiteur a soumis le formulair

        if(!$this->get('security.authorization_checker')->isGranted('ROLE_AUTEUR')){
            throw new AccessDeniedException('acces limite aux auteurs');
        }

        $advert = new Advert();
        $form= $this->get('form.factory')->create(AdvertType::class, $advert);


        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            // Ici, on s'occupera de la création et de la gestion du formulaire
            ;

            if($form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $em->persist($advert);
                $em->flush();
            }

            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

            // Puis on redirige vers la page de visualisation de cettte annonce
            return $this->redirectToRoute('oc_platform_view', array('id' => $advert->getId()));
        }

        return $this->render('OCPlatformBundle:Advert:add.html.twig',array(
            "form"=> $form->createView()
        ));
    }

    /**
     * @Security("has_role('ROLE_MODERATEUR')")
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     */
    public function editAction($id, Request $request)
    {


        $em = $this->getDoctrine()->getManager();

        $advert = $em->getRepository("OCPlatformBundle:Advert")
            ->find($id);
        $form = $this->createForm(AdvertEditType::class, $advert);

        if( Null === $advert){
            throw new NotFoundHttpException("not advert found");
        }

        if ($request->isMethod('POST') &&  $form->handleRequest($request)->isValid()) {
            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.');
            $em->flush();
            return $this->redirectToRoute('oc_platform_view', array('id' => $advert->getId()));
        }

        return $this->render('OCPlatformBundle:Advert:edit.html.twig',array(
            "advert"=> $advert,
            "form" => $form->createView()
        ));
    }

    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $advert = $em->getRepository('OCPlatformBundle:Advert')
            ->find($id);

        if( Null === $advert){
            throw new NotFoundHttpException("not advert found");
        }

        $form = $this->get('form.factory')->create();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            foreach($advert->getCategories() as $value){
                $advert->removeCategory($value);
            }
            $em->remove($advert);
            $em->flush();

            $request->getSession()->getFlashBag()->add('info', "L'annonce a bien été supprimée.");

            return $this->redirectToRoute('oc_platform_home');
        }



        return $this->render('OCPlatformBundle:Advert:delete.html.twig',
            array('advert'=>$advert,
                  'form'  =>$form->createView()));
    }

}