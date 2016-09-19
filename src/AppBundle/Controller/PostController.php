<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use AppBundle\Form\Type\PostType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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

        return $this->render('post\list.html.twig', ['trees' => $trees]);
    }

    /**
     * @Route("/contribution/{slug}", name="post_show", requirements={ "slug": "[a-zA-Z0-9-]+" })
     */
    public function showPostAction(Post $post, Request $request)
    {
        return $this->render('post\show.html.twig', ['tree' => $post]);
    }

    /**
     * @Route("/arbre/{slug}", name="post_tree_show", requirements={ "slug": "[a-zA-Z0-9-]+" })
     */
    public function showTreeAction(Post $post, Request $request)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle\Entity\Post');

        return $this->render('post\tree.html.twig', ['tree' => $post]);
    }

    /**
     * @Route("/arbre/{slug}/json", name="post_tree_json", requirements={ "slug": "[a-zA-Z0-9-]+" })
     */
    public function treeAction(Post $post, Request $request)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle\Entity\Post');

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

    /**
     * @Route("/{slug}/{child}/contribuer", name="post_add")
     * @ParamConverter("post", class="AppBundle:Post", options={"mapping": {"child": "slug"}})
     * @Method({"GET"})
     */
    public function addAction(Request $request, Post $tree, Post $parent)
    {
        $post = new Post();
        $post->setParent($parent);
        $post->setRoot($tree);

        $form = $this->createForm(
                    new PostType(),
                    $post
                );

        return $this->render('post/add.html.twig', [
            'form'          => $form->createView(),
        ]);
    }

}
