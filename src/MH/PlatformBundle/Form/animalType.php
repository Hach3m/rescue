<?php

namespace MH\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
class animalType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //$builder->add('nom')->add('dateNaissance')->add('ageApproximatif')->add('etat')->add('categorie')->add('race');
        $builder
        ->add('nom',              TextType::class)
        ->add('dateNaissance',     DateType::class)
        ->add('ageApproximatif',   IntegerType::class)
        ->add('etat',             CheckboxType::class,array('required'=>false))
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
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MH\PlatformBundle\Entity\animal'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'mh_platformbundle_animal';
    }


}
