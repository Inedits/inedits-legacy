<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\User;
use AppBundle\Entity\UserProfile;
use Symfony\Component\Form\Extension\Core\Type as Types;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationUserProfileType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('biographie', Types\TextareaType::class, [
                'required' => false,
            ])
            ->add('avatar', Types\FileType::class, [
                'required'  => false,
                'label'     => 'Image de profil',
            ])
            ->add('cover', Types\FileType::class, [
                'required'  => false,
                'label'     => 'Image de couverture',
            ])
        ;
        $builder->setAction($options['action']);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'        => UserProfile::class,
        ));
    }

    public function getBlockPrefix()
    {
        return 'user_profile';
    }
}
