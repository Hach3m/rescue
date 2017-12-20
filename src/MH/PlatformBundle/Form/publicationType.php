<?php

namespace MH\PlatformBundle\Form;
use MH\PlatformBundle\Form\imageType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FormType;

class publicationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('text',            TextType::class)
        ->add('dateAjout',       DateType::class)
        ->add('animals',          EntityType::class,array(
            'class' => 'MHPlatformBundle:animal',
            'choice_label'=>'nom',
            'multiple' => true,
          )
        )
        ->add('images', CollectionType::class, array(
                        'entry_type' => imageType::class,
                        'allow_add'    => true,
                        'allow_delete' => true,
                        'entry_options' => array('label' => false),
                  )
            )
        ->add('publier',         SubmitType::class)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MH\PlatformBundle\Entity\publication'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'mh_platformbundle_publication';
    }


}
