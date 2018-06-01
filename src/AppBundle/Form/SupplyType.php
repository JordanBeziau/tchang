<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class SupplyType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('name', TextType::class, [
            'constraints' => [ new Length(['min' => 1, 'max' => 50])],
            'label' => 'Name',
            'attr' => ['class' => 'input']
          ])
          ->add('buyingPrice', NumberType::class, [
            'label' => 'Name',
            'attr' => ['class' => 'input']
          ])
          ->add('sellingPrice', NumberType::class, [
            'label' => 'Name',
            'attr' => ['class' => 'input']
          ]);
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Supply'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_supply';
    }


}
