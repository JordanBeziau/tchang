<?php

namespace AppBundle\Form;

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
          ]);
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Provider'
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
