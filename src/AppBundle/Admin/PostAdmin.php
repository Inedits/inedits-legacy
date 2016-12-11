<?php

namespace AppBundle\Admin;

use AppBundle\Event\PostAdminSavedEvent;
use AppBundle\Events;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class PostAdmin extends AbstractAdmin
{
    private $container;

    public function __construct($code, $class, $baseControllerName, $container)
    {
        $this->container = $container;

        parent::__construct($code, $class, $baseControllerName);
    }

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
            ])
            ->add('message', 'textarea', [
                'required' => false,
            ])
        ;
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
        $listMapper->addIdentifier('title');
        $listMapper->add('user');
        $listMapper->add('status');
        $listMapper->add('createdAt');
    }

    public function preUpdate($post)
    {
        $this->container->get('event_dispatcher')->dispatch(Events::POST_ADMIN_SAVED, new PostAdminSavedEvent($post, $post->getUser()));
    }

}