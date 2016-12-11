<?php
namespace AppBundle\EventListener;

use AppBundle\Event\PostSavedEvent;
use AppBundle\Events;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class PostSavedListener implements EventSubscriberInterface
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
            Events::POST_SAVED => 'onPostSaved',
        );
    }

    public function onPostSaved(PostSavedEvent $event)
    {
        $user = $event->getUser();

        // Emails
        $message = $this->mailer->createMessage()
            ->setSubject('Inedit | La première plateforme d\'écriture collaborative')
            ->setFrom('clemence@inedits.fr', 'Inedit | La première plateforme d\'écriture collaborative')
            ->setTo([$user->getEmail()])
            ->setBody(
                $this->twig->render(
                    'email/post_add.html.twig',
                    [
                        'user' => $user,
                        'post' => $event->getPost()
                    ]
                ),
                'text/html'
            )
        ;
        $this->mailer->send($message);

        // User update
        $count = $this->em->getRepository('AppBundle\Entity\Post')->countPostByUser($user->getId());
        $user->setPostCount($count);

        $this->em->persist($user);
        $this->em->flush();
    }
}
