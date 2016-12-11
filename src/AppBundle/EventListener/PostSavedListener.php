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

    public function __construct($mailer, $twig, UrlGeneratorInterface $router)
    {
        $this->twig   = $twig;
        $this->mailer = $mailer;
        $this->router = $router;
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
        $message = $this->mailer->createMessage()
            ->setSubject('Inedit | La première plateforme d\'écriture collaborative')
            ->setFrom('study-abraod@dev.com', 'Inedit | La première plateforme d\'écriture collaborative')
            ->setTo([$event->getUser()->getEmail()])
            ->setBody(
                $this->twig->render(
                    'email/post_add.html.twig',
                    [
                        'user' => $event->getUser(),
                        'post' => $event->getPost()
                    ]
                ),
                'text/html'
            )
        ;
        $this->mailer->send($message);
    }
}
