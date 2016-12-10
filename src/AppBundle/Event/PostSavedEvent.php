<?php

namespace AppBundle\Event;

use AppBundle\Entity\Post;
use AppBundle\Entity\User;
use Symfony\Component\EventDispatcher\Event;

class PostSavedEvent extends Event
{

    private $post;
    private $user;

    public function __construct(Post $post, User $user)
    {
        $this->post = $post;
        $this->user = $user;
    }

    public function getPost()
    {
        return $this->post;
    }

    public function getUser()
    {
        return $this->user;
    }

}
