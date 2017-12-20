<?php

namespace MH\PlatformBundle\Controller;
use MH\PlatformBundle\Entity\animal;
use MH\PlatformBundle\Form\animalType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;


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

    public function ajouterAction(Request $request )
    {
        $publication=new animal();
        $formBuilder=$this->get('form.factory')->createBuilder(animalType::class,$publication);
        /*$formBuilder
        ->add('nom',              TextType::class)
        ->add('dateNaissance',     DateType::class)
        ->add('ageApproximatif',   IntegerType::class)
        ->add('etat',             CheckboxType::class)
        ->add('categorie',        EntityType::class,array(
              'class'=>'MHPlatformBundle:categorie',
              'choice_label'=>'nom',
                )
              )
        ->add('race',             EntityType::class,array(
              'class'=>'MHPlatformBundle:race',
              'choice_label'=>'nom',
                )
              )
        ->add('publier',         SubmitType::class);
        */
        /*$formBuilder
        ->add('text',            TextType::class)
        ->add('dateAjout',       DateType::class)
        ->add('animals',          EntityType::class,array(
            'class' => 'MHPlatformBundle:animal',
            'choice_label'=>'nom',
          )
        )
        ->add('publier',         SubmitType::class)
        ;*/
        $form=$formBuilder->getForm();
        if($request->isMethod('POST'))
        {
            $form->handleRequest($request);
            if($form->isValid())
            {
              $em=$this->getDoctrine()->getManager();
              $em->persist($publication);
              $em->flush();

            }
        }
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
