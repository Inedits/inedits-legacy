<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Post;
use Symfony\Component\Form\Extension\Core\Type as Types;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', Types\TextType::class, [
                'label' => 'Titre'
            ])
            ->add('Content', Types\TextareaType::class, [
                'label' => 'Contenu',
            ])
        ;
    }

    public function getBlockPrefix()
    {
        return 'app_post_new';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'        => Post::class,
        ));
    }
}
