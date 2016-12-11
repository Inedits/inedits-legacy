<?php
namespace AppBundle\EventListener;

use AppBundle\Event\PostAdminSavedEvent;
use AppBundle\Events;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class PostAdminSavedListener implements EventSubscriberInterface
{
    private $twig;
    private $mailer;
    private $router;
    private $em;

    public function __construct($mailer, $twig, UrlGeneratorInterface $router, $em)
    {
        $this->twig   = $twig;
        $this->mailer = $mailer;
        $this->router = $router;
        $this->em     = $em;
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            Events::POST_ADMIN_SAVED => 'onPostAdminSaved',
        );
    }

    public function onPostAdminSaved(PostAdminSavedEvent $event)
    {
        $post               = $event->getPost();
        $oldPost            = $this->em->getRepository('AppBundle:Post')->findOneById($post->getId());
        $hasChangedStatus   = ($post->getStatus()->getId() == $oldPost->getStatus()->getId()) ? true : false;
        $user               = $event->getUser();

        if ($hasChangedStatus) {
            if ($post->getStatus()->getId() === 2) {
                // User
                $message = $this->mailer->createMessage()
                    ->setSubject('Inedit | La première plateforme d\'écriture collaborative')
                    ->setFrom('clemence@inedits.fr', 'Inedit | La première plateforme d\'écriture collaborative')
                    ->setTo([$event->getUser()->getEmail()])
                    ->setBody(
                        $this->twig->render(
                            'email/post_admin_add_approve.html.twig',
                            [
                                'user'    => $user,
                                'post'    => $post
                            ]
                        ),
                        'text/html'
                    )
                ;
                $this->mailer->send($message);

                // Previous User
                if ($post->getParent()) {
                    $message = $this->mailer->createMessage()
                        ->setSubject('Inedit | La première plateforme d\'écriture collaborative')
                        ->setFrom('clemence@inedits.fr', 'Inedit | La première plateforme d\'écriture collaborative')
                        ->setTo([$event->getUser()->getEmail()])
                        ->setBody(
                            $this->twig->render(
                                'email/post_admin_add_approve_previous.html.twig',
                                [
                                    'user'    => $user,
                                    'post'    => $post
                                ]
                            ),
                            'text/html'
                        )
                    ;
                    $this->mailer->send($message);
                }
            }
            if ($post->getStatus()->getId() === 3) {
                $message = $this->mailer->createMessage()
                    ->setSubject('Inedit | La première plateforme d\'écriture collaborative')
                    ->setFrom('clemence@inedits.fr', 'Inedit | La première plateforme d\'écriture collaborative')
                    ->setTo([$event->getUser()->getEmail()])
                    ->setBody(
                        $this->twig->render(
                            'email/post_admin_add_deny.html.twig',
                            [
                                'user'    => $user,
                                'post'    => $post
                            ]
                        ),
                        'text/html'
                    )
                ;
                $this->mailer->send($message);
            }
        }
    }
}
