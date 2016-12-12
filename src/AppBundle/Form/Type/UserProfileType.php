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
            ->add('favoriteAuthors', Types\TextType::class, [
                'required'  => false,
                'label'     => 'Auteur(s) préféré(e)'
            ])
            ->add('style', Types\TextType::class, [
                'required' => false,
            ])
            ->add('favoriteBook', Types\TextType::class, [
                'required'  => false,
                'label'     => 'Livre préféré'
            ])
            ->add('inspiration', Types\TextareaType::class, [
                'required' => false,
                'label'     => 'Inspiration du moment'
            ])
            ->add('favoriteGenre', Types\TextType::class, [
                'required'  => false,
                'label'     => 'Genre(s) de prédilection'
            ])
            ->add('experience', Types\TextareaType::class, [
                'required' => false,
                'label'     => 'En quoi l\'écriture collaborative vous motive-t-elle ?'
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
            ->add('avatarFile', Types\FileType::class, [
                'required'  => false,
                'label'     => 'Image de profil',
            ])
            ->add('coverFile', Types\FileType::class, [
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
            'data_class'            => UserProfile::class,
            'validation_groups'     => array('edit'),
        ));
    }

    public function getBlockPrefix()
    {
        return 'user_profile';
    }
}
