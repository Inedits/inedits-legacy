<?php

namespace AppBundle\Form\Transformer;

use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\DataTransformerInterface;

class PostTransformer implements DataTransformerInterface
{

    public function transform($post)
    {
        return $post;
    }

    public function reverseTransform($post)
    {
        $post->setContentPlain($post->getContent());

        return $post;
    }
}