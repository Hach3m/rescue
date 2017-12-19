<?php

namespace MH\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PubController extends Controller
{
    public function indexAction()
    {
        return $this->render('MHPlatformBundle:Pub:index.html.twig', array(
            // ...
        ));
    }

    public function consulterAction($id)
    {
        return $this->render('MHPlatformBundle:Pub:consulter.html.twig', array(
            // ...
        ));
    }

    public function ajouterAction()
    {
        return $this->render('MHPlatformBundle:Pub:ajouter.html.twig', array(
            // ...
        ));
    }

    public function supprimerAction($id)
    {
        return $this->render('MHPlatformBundle:Pub:supprimer.html.twig', array(
            // ...
        ));
    }

}
