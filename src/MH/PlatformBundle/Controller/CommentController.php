<?php

namespace MH\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use MH\PlatformBundle\Entity\Comment;
use MH\PlatformBundle\Form\CommentType;
use MH\PlatformBundle\Entity\publication;
use MH\UserBundle\Entity\User;
class CommentController extends Controller
{
    public function createAction(Request $request)
    {
        $request->isXmlHttpRequest();
        $data=$request->request->all();
        //$request->request->replace(is_array($data) ? $data : array());
        if(empty($data)){
          $this->log("Content was empty");
           throw new BadRequestHttpException("Content is empty");
        }

        else{
          $pubId=$data['id_Pub'];
          $text=$data['comText'];
          $t=$data['type'];
          $permission=false;
          if($t=='true'){
            $type='Advice';
            if($this->getUser()->getType()=='Veterinary'){
              $permission=true;
            }
          }
          elseif ($t=='false') {
            $type='Comment';
          }
          else {
            throw new \Exception("Error Processing Request", 1);

          }
          $pub=$this->getPublication($pubId);
          $comment=new Comment();
          if(isset($pubId)&&($pub!=null) && isset($text) && isset($type)){
            if (($type=='Advice')&&(!$permission)) {
              throw new \Exception("Error Processing Request", 1);

            }
            $comment->setPublication($pub);
            $comment->setDateAjout(new \DateTime());
            $comment->setText($text);
            $comment->setType($type);
            $comment->setUser($this->getUser());
            $em = $this->getDoctrine()
                       ->getManager();
            $em->persist($comment);
            $em->flush();
            return $this->render('MHPlatformBundle:Comment:create.html.twig', array(
                'comment'=>$comment
            ));
          }

        }
        $comment=new Comment();
        return $this->render('MHPlatformBundle:Comment:create.html.twig', array(
            'comment'=>$comment
        ));

    }

    public function showAction(Request $request)
    {
        $data=$request->request->all();
        $pubId=$data['id_Pub'];
        //$pubId=$req->query->get('id_pub');
        $em=$this->getDoctrine()->getManager();
        $comRepo=$em->getRepository('MHPlatformBundle:Comment');
        $pub=$this->getPublication($pubId);
        $comments=$comRepo->commentFindAll($pubId);
        return $this->render('MHPlatformBundle:Comment:show.html.twig', array(
            'listeComment'=>$comments
        ));
    }

    public function deleteAction()
    {
        return $this->render('MHPlatformBundle:Comment:delete.html.twig', array(
            // ...
        ));
    }
    protected function getPublication($pubId)
    {
        $em = $this->getDoctrine()
                    ->getEntityManager();

        $pub = $em->getRepository('MHPlatformBundle:publication')->find($pubId);

        if (!$pub) {
            return null;
        }

        return $pub;
    }

}
