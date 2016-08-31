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
        //$arrayTree['theTree']   = $repository->childrenHierarchy(null, false, []);

        $query = $this->getDoctrine()->getManager()
            ->createQueryBuilder()
            ->select('node, user')
            ->from('AppBundle\Entity\Post', 'node')
            ->leftJoin('node.user', 'user')
            ->where('node.root = :postID')
            ->setParameter('postID', $post->getId())
            ->getQuery()
        ;
// dump($post);
// exit();
        $arrayTree['theTree'] = $repository->buildTree($query->getArrayResult($post), []);
        $response = new Response(json_encode($arrayTree));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

}
