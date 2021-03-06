<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\User;
use AppBundle\Form\Type\RegistrationUserProfileType;
use Symfony\Component\Form\Extension\Core\Type as Types;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', Types\TextType::class, [
                'label' => false,
                'attr'  => [
                    'placeholder'   => 'Votre Prénom',
                ]
            ])
            ->add('lastName', Types\TextType::class, [
                'label' => false,
                'attr'  => [
                    'placeholder'   => 'Votre Nom',
                ]
            ])
            ->add('gtu', Types\ChoiceType::class, [
                'choices'   => [
                    1   => 'j\'ai lu et j\'accepte les conditions générales d\'utilisation'
                ],
                'label'     => false,
                'expanded'  => true,
                'multiple'  => true,
            ])
            ->add('userProfile', new RegistrationUserProfileType())
            ->remove('username')
        ;
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';

        // Or for Symfony < 2.8
        // return 'fos_user_registration';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'cascade_validation'    => true,
        ));
    }
}
