<?php

namespace AppBundle\Form;

use AppBundle\Entity\Genus;
use AppBundle\Entity\SubFamily;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Repository\SubFamilyRepository;

class GenusFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            //->add('subFamily', null, [
            //  'placeholder' => 'Choose a Sub Family'
            //])
            ->add('subFamily', EntityType::class, [
              'placeholder' => 'Choose a Sub Family',
              'class' => SubFamily::class,
              'query_builder' => function(SubFamilyRepository $repo) {
                  return $repo->createAlphabeticalQueryBuilder();
              },
            ])
            ->add('speciesCount')
            ->add('funFact')
            ->add('firstDiscoveredAt',DateType::class , [
              'widget' => 'single_text',
              'attr' => ['class' => 'js-datepicker'],
              'html5' => false,

            ])
            ->add('isPublished', ChoiceType::class, [
              'choices' => [
                'Yes' => true,
                'No' => false
              ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Genus::class
        ]);
    }
}