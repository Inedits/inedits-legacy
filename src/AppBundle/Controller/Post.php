<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post as IneditsPost;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class Post extends Controller
{
    /**
     * @Route("/contribution/{slug}", name="post_show")
     */
    public function showAction(Request $request, IneditsPost $post)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle\Entity\Post');

        return $this->render('default\default.html.twig', ['tree' => $post]);
    }

    /**
     * @Route("/contribution/{id}/json", name="post_json")
     */
    public function treeAction(Request $request)
    {
        $repository             = $this->getDoctrine()->getRepository('AppBundle\Entity\Post');
        $post                   = $repository->find($request->attributes->get('id'));
        $arrayTree['theTree']   = $repository->childrenHierarchy($post, true, [], true);

        $response = new Response(json_encode($arrayTree));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

}
