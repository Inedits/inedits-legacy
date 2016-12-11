<?php
namespace AppBundle\EventListener;

use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class RegistrationListener implements EventSubscriberInterface
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
            FOSUserEvents::REGISTRATION_CONFIRM => 'onRegistrationConfirm',
        );
    }

    public function onRegistrationConfirm(GetResponseUserEvent $event)
    {
        $message = $this->mailer->createMessage()
            ->setSubject('Nouvel utilisateur')
            ->setFrom('clemence@inedits.fr', 'Inedit | La première plateforme d\'écriture collaborative')
            ->setTo([$event->getUser()->getEmail()])
            ->setBody(
                $this->twig->render(
                    'email/user_add.html.twig',
                    [
                        'user' => $event->getUser(),
                    ]
                ),
                'text/html'
            )
        ;
        $this->mailer->send($message);

        $url = $this->router->generate('fos_user_profile_show');

        $event->setResponse(new RedirectResponse($url));
    }

    public function onRegistrationCompleted(GetResponseUserEvent $event)
    {
        $url = $this->router->generate('homepage');

        $event->setResponse(new RedirectResponse($url));
    }
}
