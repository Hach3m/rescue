<?php

namespace MH\PlatformBundle\Controller;
use MH\PlatformBundle\Entity\publication;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FormType;

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
        $publication=new publication();
        $formBuilder=$this->get('form.factory')->createBuilder(FormType::class,$publication);
        $formBuilder
        ->add('text',            TextType::class)
        ->add('dateAjout',       DateType::class)
        ->add('animals',          EntityType::class,array(
            'class' => 'MHPlatformBundle:animal',
            'choice_label'=>'nom',
          )
        )
        ->add('publier',         SubmitType::class)
        ;
        $form=$formBuilder->getForm();

        return $this->render('MHPlatformBundle:Pub:ajouter.html.twig', array(
            'form'=>$form->createView(),
        ));
    }

    public function supprimerAction($id)
    {
        return $this->render('MHPlatformBundle:Pub:supprimer.html.twig', array(
            // ...
        ));
    }

}
