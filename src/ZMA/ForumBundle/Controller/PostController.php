<?php

namespace ZMA\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class PostController extends Controller
{
    public function indexAction($page)
    {
        if($page< 1){
            throw new NotFoundHttpException("Page  $page inexistante.");
        }
        return $this->render('ZMAForumBundle:post:index.html.twig');
    }

//    public function addAction(){
//        return $this->render('post/add.twig');
//    }
    public function viewAction($id, $_format)
    {
        $url = $this->generateUrl('zma_forum_homepage',
                array('id'=>$id),
                UrlGeneratorInterface::ABSOLUTE_URL);
        return $this->render('ZMAForumBundle:Post:view.html.twig', array(
            'id' => $id
        ));



//        return new JsonResponse(array('id'=>$id));
    }

    public function addAction(Request $request){
        if($request->isMethod('POST')){
            $request->getSession()->getFlashBag()->add('notice','Post bien enregistree ');

            return $this->redirectToRoute('zma_forum_view',array('id'=> 5));
        }

        return $this->render('ZMAForumBundle:post:add.html.twig');
    }

    public function editAction(Request $request){
        if($request->isMethod('POST')){
            $request->getSession()->getFlashBag()->add('notice','Post bien modifiee ');

            return $this->redirectToRoute('zma_forum_view',array('id'=> 5));
        }

        return $this->render('ZMAForumBundle:post:edit.html.twig');
    }

    public function deleteAction($id, Request $request){

        $request->getSession()->getFlashBag()->add('notice','Le post est supprimé ');
        return $this->redirectToRoute('zma_forum_view',array('id'=>100));
    }

}
