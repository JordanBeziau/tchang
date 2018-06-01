<?php

namespace AppBundle\Form;

use AppBundle\Entity\ProviderSupply;
use AppBundle\Entity\Supply;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class ProviderType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      dump($options['providerSupply']);
        $builder
          ->add('name', TextType::class, [
            'constraints' => new Length(['min' => 1, 'max' => 50]),
            'label' => 'Name',
            'attr' => ['class' => 'input']
          ])
          ->add('address', TextareaType::class, [
            'constraints' => new Length(['min' => 1, 'max' => 255]),
            'label' => 'Address',
            'attr' => ['class' => 'textarea']
          ])
          ->add('siret', IntegerType::class, [
            'label' => 'Siret',
            'attr' => ['class' => 'input']
          ])
          ->add('active', ChoiceType::class, [
            'label' => 'Active',
            'attr' => ['class' => 'radio'],
            'choices' => [
              'Yes' => 1,
              'No' => 0
            ],
            'expanded' => true
          ])
          ->add('providerSupply', EntityType::class, [
            'label' => 'Supplies',
            'attr' => ['class' => 'checkbox'],
            'mapped' => false,
            'class' => Supply::class,
            'multiple' => true,
            'expanded' => true,
            'choice_attr' => function ($providerSupply) use ($options) {
              $attr = [];
              foreach ($options['providerSupply'] as $option) {
                if ($option->getIdSupply()->getId() === $providerSupply->getId()) {
                  $attr['checked'] = 'checked';
                }
              }
              return $attr;
            }
          ]);
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Provider',
            'providerSupply' => null,
            'allow_extra_fields' => true
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_provider';
    }


}
