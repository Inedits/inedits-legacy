<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class PostController extends Controller
{
    /**
     * @Route("/contribution/{slug}", name="post_show")
     */
    public function showAction(Post $post, Request $request)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle\Entity\Post');

        return $this->render('default\default.html.twig', ['tree' => $post]);
    }

    /**
     * @Route("/contribution/{slug}/json", name="post_json")
     */
    public function treeAction(Post $post, Request $request)
    {
        $repository             = $this->getDoctrine()->getRepository('AppBundle\Entity\Post');
        $arrayTree['theTree']   = $repository->childrenHierarchy(null, false, []);

        $response = new Response(json_encode($arrayTree));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

}
