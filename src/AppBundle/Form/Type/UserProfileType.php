<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\User;
use AppBundle\Entity\UserProfile;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type as Types;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class UserProfileType extends AbstractType
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
            ->add('facebook', Types\TextType::class, [
                'required' => false,
            ])
            ->add('twitter', Types\TextType::class, [
                'required' => false,
            ])
            ->add('website', Types\TextType::class, [
                'required' => false,
            ])
            ->add('style', Types\TextType::class, [
                'required' => false,
            ])
            ->add('experience', Types\TextareaType::class, [
                'required' => false,
                'label'     => 'En quoi l\'écriture collaborative vous motive-t-elle ?'
            ])
            ->add('favoriteBook', Types\TextType::class, [
                'required'  => false,
                'label'     => 'Livre préféré'
            ])
            ->add('avatar_file', Types\FileType::class, [
                'required'  => false,
                'label'     => 'Image de profil',
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
