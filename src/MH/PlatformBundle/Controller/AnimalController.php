<?php

namespace MH\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MH\PlatformBundle\Entity\animal;
use MH\PlatformBundle\Form\animalType;
use MH\UserBundle\Entity\User;

use Symfony\Component\HttpFoundation\Request;
class AnimalController extends Controller
{
    public function addAction(Request $request)
    {
      $animal=new Animal();
      $formBuilder=$this->get('form.factory')->createBuilder(animalType::class,$animal);

      $form=$formBuilder->getForm();
      if($request->isMethod('POST'))
      {
          $form->handleRequest($request);
          if($form->isValid())
          {

            $animal->setUser($this->getUser());
            $em=$this->getDoctrine()->getManager();
            $em->persist($animal);
            $em->flush();
            return $this->redirectToRoute('index');
          }
      }
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
        return $this->render('MHPlatformBundle:Animal:add.html.twig', array(
            'form'=>$form->createView(),
        ));
    }

    public function showAction($id)
    {

      $em=$this->getDoctrine()->getManager();
      $animalRepository=$em->getRepository('MHPlatformBundle:animal');
      $userRepo=$em->getRepository('MHUserBundle:User');
      $user=$userRepo->find($id);
      $animals=$animalRepository->findBy(array('user'=>$user));
        return $this->render('MHPlatformBundle:Animal:show.html.twig', array(
            'animals'=>$animals
        ));
    }

    public function deleteAction()
    {
        return $this->render('MHPlatformBundle:Animal:delete.html.twig', array(
            // ...
        ));
    }

    public function adoptAction()
    {
        return $this->render('MHPlatformBundle:Animal:adopt.html.twig', array(
            // ...
        ));
    }

}
