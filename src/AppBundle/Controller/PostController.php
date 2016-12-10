<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use AppBundle\Form\Type\PostType;
use AppBundle\Events;
use AppBundle\Event\PostSavedEvent;
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
        $userRepo   = $this->getDoctrine()->getRepository('AppBundle:User');
        $trees      = $repository->getRootPost();

        foreach ($trees as $value)
        {
            $array[] = [
                'Tree'  => $value,
                'Users' => $userRepo->findUsersByTree($value->getId(), 3),
            ];
        }

        return $this->render('post\list.html.twig', ['trees' => $array]);
    }

    /**
     * @Route("/contribution/{slug}", name="post_show", requirements={ "slug": "[a-zA-Z0-9-]+" })
     */
    public function showPostAction(Post $post, Request $request)
    {
        return $this->render('post\show.html.twig', ['tree' => $post->getUsers()]);
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
            ->select('node, user, parent')
            ->from('AppBundle\Entity\Post', 'node')
            ->leftJoin('node.user', 'user')
            ->leftJoin('node.parent', 'parent')
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
     * @Route("/arbre/{slug}/{parent}/contribuer", name="post_add")
     * @ParamConverter("tree", class="AppBundle:Post", options={"mapping": {"slug": "slug"}})
     * @ParamConverter("parent", class="AppBundle:Post", options={"mapping": {"parent": "slug"}})
     * @Method({"GET", "POST"})
     */
    public function addAction(Request $request, Post $tree, Post $parent)
    {
        $user = $this->getUser();
        $post = new Post($tree, $user);
        $post->setParent($parent);

        $form = $this->createForm(
            new PostType(),
            $post
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $post = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            $this->get('event_dispatcher')->dispatch(Events::POST_SAVED, new PostSavedEvent($post, $user));

            return $this->redirectToRoute('post_saved_success', ['slug' => $post->getSlug()]);
        }

        if ($form->isSubmitted() && !$form->isValid()) {
            $this->get('session')->getFlashBag()->add('danger', 'Des erreurs sont survenues.');
        }

        return $this->render('post/add.html.twig', [
            'form'   => $form->createView(),
            'parent' => $parent,
        ]);
    }

    /**
     * @Route("/{slug}/confirmation", name="post_saved_success")
     * @Method({"GET"})
     */
    public function addSuccessAction(Request $request, Post $post)
    {

        return $this->render('post/confirmation.html.twig');
    }

}
