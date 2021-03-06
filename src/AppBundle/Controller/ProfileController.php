<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Model\UserInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use FOS\UserBundle\Controller\RegistrationController as BaseController;

/**
 * Controller managing the user profile
 *
 * @author Christophe Coevoet <stof@notk.org>
 */
class ProfileController extends Controller
{
    /**
     * @Route("/profile/{slug}", name="fos_user_profile_show")
     * @Method({"GET"})
     */
    public function showAction(User $user=null)
    {
        if ($user === null) {
            $user = $this->getUser();
        }
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        $post  = $this->getDoctrine()->getRepository('AppBundle:Post')->getLastPostByUser($user->getId());
        $users = $post ? $this->getDoctrine()->getRepository('AppBundle:User')->findUsersByTree($post->getRoot()->getId(), 1) : null;

        return $this->render('FOSUserBundle:Profile:show.html.twig', array(
            'user'  => $user,
            'post'  => $post,
            'users' => $users,
        ));
    }

    /**
     * @Route("/profile/{slug}/modifier", name="fos_user_profile_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, User $user)
    {
// dump($user);
// exit('cocc');
        $user->setUserProfile($user->getUserProfile());

        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $changeFormFactory = $this->get('fos_user.change_password.form.factory');
        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->get('fos_user.profile.form.factory');

        $changeForm = $changeFormFactory->createForm();

        $form = $formFactory->createForm();
        $form->setData($user);

        $form->handleRequest($request);

        if ($form->isValid()) {
            /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
            $userManager = $this->get('fos_user.user_manager');

            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_SUCCESS, $event);

            // Retrieve Files Objects
            $avatar     = $form['userProfile']->get('avatarFile')->getData();
            $cover      = $form['userProfile']->get('coverFile')->getData();

            if($avatar)
            {
                $fileName = md5(uniqid()).'.'.$avatar->guessExtension();

                $avatar->move(
                    $this->getParameter('avatar_directory'),
                    $fileName
                );

                $user->getUserProfile()->setAvatar($fileName);
            }
            if($cover)
            {
                $fileName = md5(uniqid()).'.'.$cover->guessExtension();

                $cover->move(
                    $this->getParameter('cover_directory'),
                    $fileName
                );

                $user->getUserProfile()->setCover($fileName);
            }

            $userManager->updateUser($user);

            if (null === $response = $event->getResponse()) {
                $url = $this->generateUrl('fos_user_profile_show', ['slug' => $user->getSlug()]);
                $response = new RedirectResponse($url);
            }

            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

            return $response;
        }

        return $this->render('FOSUserBundle:Profile:edit.html.twig', array(
            'form'          => $form->createView(),
            'change_form'   => $changeForm->createView(),
            'user'          => $user,
        ));
    }
}
