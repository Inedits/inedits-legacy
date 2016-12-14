<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class UserAdmin extends AbstractAdmin
{
    private $container;

    public function __construct($code, $class, $baseControllerName, $container)
    {
        $this->container = $container;

        parent::__construct($code, $class, $baseControllerName);
    }

    protected function configureFormFields(FormMapper $formMapper)
    {

        $roles = [];

        foreach ($this->container->getParameter('security.role_hierarchy.roles') as $name => $rolesHierarchy) {
            $roles[$name] = $name;

            foreach ($rolesHierarchy as $role) {
                if (!isset($roles[$role])) {
                    $roles[$role] = $role;
                }
            }
        }

        $formMapper
            ->add('firstName', 'text')
            ->add('lastName', 'text')
            ->add('roles','choice',[
                'choices'   => $roles,
                'multiple'  => true,
                'expanded'  => true,
            ])
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('firstName');
        $datagridMapper->add('lastName');
        $datagridMapper->add('enabled');
        $datagridMapper->add('roles');
        $datagridMapper->add('createdAt');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id');
        $listMapper->add('firstName');
        $listMapper->add('lastName');
        $listMapper->add('enabled');
        $listMapper->add('roles');
        $listMapper->add('createdAt');
        $listMapper->add('_action', 'actions', array(
            'actions' => array(
                'edit'      => [],
                'see'  => [
                    'template' => 'user/_see_button.html.twig',
                ],
            )
        ));
    }

    // public function preUpdate($post)
    // {
    //     $this->container->get('event_dispatcher')->dispatch(Events::POST_ADMIN_SAVE, new PostAdminSavedEvent($post, $post->getUser()));
    // }

    // public function postUpdate($post)
    // {
    //     $this->container->get('event_dispatcher')->dispatch(Events::POST_ADMIN_SAVED, new PostAdminSavedEvent($post, $post->getUser()));
    // }

}