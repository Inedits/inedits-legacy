<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class PostAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', 'text')
            ->add('content', 'textarea', [
                'attr'  => [
                    'class'   => 'wysiwyg',
                ]
            ])
            ->add('user', 'entity', [
                'class' => 'AppBundle\Entity\User',
                'property' => 'slug',
            ])
            ->add('status', 'entity', [
                'class' => 'AppBundle\Entity\PostStatus',
                'property' => 'label',
            ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('title');
        $datagridMapper->add('status');
        $datagridMapper->add('user');
        $datagridMapper->add('createdAt');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('user');
    }
}