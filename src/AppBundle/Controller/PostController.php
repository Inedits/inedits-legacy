<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class PostController extends Controller
{
    /**
     * @Route("/les-arbres", name="tree_list")
     * @Method({"GET"})
     */
    public function listPostAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Post');
        $trees      = $repository->getRootPost();
dump($trees);
exit();
        return $this->render('post\list.html.twig', ['trees' => $trees]);
    }

    /**
     * @Route("/contribution/{slug}", name="post_show", requirements={ "slug": "[a-zA-Z0-9-]+", "id": "\d+" })
     */
    public function showPostAction(Post $post, Request $request)
    {
        return $this->render('post\show.html.twig', ['tree' => $post]);
    }

    /**
     * @Route("/arbre/{slug}", name="post_tree_show", requirements={ "slug": "[a-zA-Z0-9-]+", "id": "\d+" })
     */
    public function showTreeAction(Post $post, Request $request)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle\Entity\Post');

        return $this->render('post\tree.html.twig', ['tree' => $post]);
    }

    /**
     * @Route("/contribution/{slug}/json", name="post_json", requirements={ "slug": "[a-zA-Z0-9-]+", "id": "\d+" })
     */
    public function treeAction(Post $post, Request $request)
    {
        $repository             = $this->getDoctrine()->getRepository('AppBundle\Entity\Post');

        $query = $this->getDoctrine()->getManager()
            ->createQueryBuilder()
            ->select('node, user')
            ->from('AppBundle\Entity\Post', 'node')
            ->leftJoin('node.user', 'user')
            ->where('node.root = :postID')
            ->setParameter('postID', $post->getId())
            ->getQuery()
        ;

        $arrayTree['theTree'] = $repository->buildTree($query->getArrayResult($post), []);

        $response = new Response(json_encode($arrayTree));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

}
