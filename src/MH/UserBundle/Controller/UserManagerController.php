<?php

namespace MH\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserManagerController extends Controller
{
    public function voirUserAction()
    {
        $userManager=$this->get('fos_user.user_manager');
        $user=$userManager->findUserBy(array('username'=>'hachem'));
        return $this->render('MHUserBundle:UserManager:voir_user.html.twig', array(
            'user'=>$user
        ));
    }

    public function modifierUserAction()
    {
        $userManager=$this->get('fos_user.user_manager');
        $user=$userManager->findUserBy(array('username'=>'hachem'));
        $user->setEmail('hachem@gmail.com');
        $userManager->updateUser($user);
        return $this->render('MHUserBundle:UserManager:modifier_user.html.twig', array(
            'user'=>$user
        ));
    }

    public function supprimerUserAction()
    {
      $userManager=$this->get('fos_user.user_manager');
      $user=$userManager->findUserBy(array('username'=>'hachem'));
      $userManager->deleteUser($user);
        return $this->render('MHUserBundle:UserManager:supprimer_user.html.twig', array(
            'user'=>$user
        ));
    }

}
