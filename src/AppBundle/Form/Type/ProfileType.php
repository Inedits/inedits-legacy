<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\User;
use AppBundle\Entity\UserProfileType as Profile;
use AppBundle\Form\Type\UserProfileType;
use FOS\UserBundle\Form\Type\ChangePasswordFormType;
use Symfony\Component\Form\Extension\Core\Type as Types;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder
                ->add('firstName', Types\TextType::class, [
                    'label' => 'Prénom'
                ])
                ->add('lastName', Types\TextType::class, [
                    'label' => 'Nom'
                ])
                ->add('userProfile', new UserProfileType())
                ->remove('username')
                ->remove('current_password')
            ;
        }

        public function getParent()
        {
            return 'FOS\UserBundle\Form\Type\ProfileFormType';

            // Or for Symfony < 2.8
            // return 'fos_user_Profile';
        }

        public function getBlockPrefix()
        {
            return 'app_user_profile';
        }

        // For Symfony 2.x
        public function getName()
        {
            return $this->getBlockPrefix();
        }
}
