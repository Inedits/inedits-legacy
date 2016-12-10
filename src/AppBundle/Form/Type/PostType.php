<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Post;
use AppBundle\Form\Transformer\PostTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type as Types;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', Types\TextType::class, [
                'mapped'        => false,
                'label'         => false,
                'attr'  => [
                    'placeholder'   => 'Votre Prénom',
                ]
            ])
            ->add('lastName', Types\TextType::class, [
                'mapped'        => false,
                'label'         => false,
                'attr'  => [
                    'placeholder'   => 'Votre Nom',
                ]
            ])
            ->add('title', Types\TextType::class, [
                'label'         => false,
                'attr'  => [
                    'placeholder'   => 'Titre de la contribution',
                ]
            ])
            ->add('content', Types\TextareaType::class, [
                'required' => false,
                'label' => false,
                'attr'  => [
                    'class'   => 'wysiwyg',
                ]
            ])
            ->add('content_plain', Types\HiddenType::class)
            ->addModelTransformer(new PostTransformer())
            ->add('gtu', Types\ChoiceType::class, [
                'choices'   => [
                    1   => 'j\'ai lu et j\'accepte les conditions générales d\'utilisation'
                ],
                'label'     => false,
                'expanded'  => true,
                'multiple'  => true,
            ])
            ->add('root_id', Types\HiddenType::class, [
                'mapped' => false,
            ])
            ->add('parent_id', Types\HiddenType::class, [
                'mapped' => false,
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
