<?php
namespace AppBundle\EventListener;

use AppBundle\Event\PostSavedEvent;
use AppBundle\Events;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class PostSavedListener implements EventSubscriberInterface
{
    private $router;

    public function __construct(UrlGeneratorInterface $router)
    {
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
        // Send Emails
        //exit('coucou');
    }
}
