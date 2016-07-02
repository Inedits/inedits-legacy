<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\User;
use AppBundle\Entity\UserProfile;
use Symfony\Component\Form\Extension\Core\Type as Types;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserProfileType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', Types\TextType::class)
            ->add('lastName', Types\TextType::class)
            ->add('email', Types\EmailType::class)
            ->add('phoneNumber', Types\TextType::class, [
                'label' => 'Phone Number'
            ])
            ->add('extended', Types\HiddenType::class, [
                'mapped'    => false,
            ])
        ;

        if ($options['extended'])
        {
            $builder
                ->add('birthday', Types\BirthdayType::class)
                ->add('country', Types\CountryType::class, [
                    'placeholder'   => 'Choose your country',
                ])
                ->add('state', Types\TextType::class, [
                    'required' => false,
                ])
                ->add('zipcode', Types\TextType::class, [
                    'required' => false,
                ])
                ->add('work_experience', Types\ChoiceType::class, [
                    'choices'       => [
                        'Fresher'           => 'Fresher',
                        'upto 2 years'      => 'upto 2 years',
                        '2-5 years'         => '2-5 years',
                        '5-10 years'        => '5-10 years',
                        '10 years or more'  => '10 years or more',
                    ],
                    'placeholder'   => 'Choose below',
                ])
                ->add('enrollPeriod', Types\ChoiceType::class, [
                    'choices'       => [
                        'Fall 2016'     => 'Fall 2016',
                        'Spring 2017'   => 'Spring 2017',
                        'Fall 2017'     => 'Fall 2017',
                        'Don\'t Know'   => 'Don\'t Know',
                        'Other'         => 'Other',
                    ],
                    'placeholder'   => 'Choose below',
                ])
                ->add('programMode', Types\ChoiceType::class, [
                    'choices'       => [
                        'Online Mode'       => 'Online Mode',
                        'Classroom program' => 'Classroom program',
                    ],
                    'expanded'   => true,
                    'multiple'   => false,
                ])
                ->add('previousSchool', Types\TextareaType::class)
                ->add('profileId', EntityType::class, [
                    'class'         => 'AppBundle:Profile',
                    'choice_label'  => 'name',
                    'placeholder'   => 'Choose your profile',
                    'label'         => 'Current profile',
                ])
                ->add('studyAreaId', EntityType::class, [
                    'class'         => 'AppBundle:StudyArea',
                    'choice_label'  => 'name',
                    'placeholder'   => 'Choose your interest',
                    'label'         => 'Study Area',
                ])
                ->add('degreeId', EntityType::class, [
                    'class'         => 'AppBundle:Degree',
                    'choice_label'  => 'name',
                    'placeholder'   => 'Choose your degree',
                    'label'         => 'Degree',
                ])
            ;
        }
        $builder->setAction($options['action']);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'        => User::class,
        ));
    }

    public function getBlockPrefix()
    {
        return 'user';
    }
}
