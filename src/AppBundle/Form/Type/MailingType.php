<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Mailing;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type as Types;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MailingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mail', Types\EmailType::class, [
                'attr'  => [
                    'placeholder'   => 'Adresse email',
                ]
            ])
            ->setAction($options['action'])
        ;
    }

    public function getBlockPrefix()
    {
        return 'app_mailing_new';
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
            'data_class'        => Mailing::class,
        ));
    }
}
