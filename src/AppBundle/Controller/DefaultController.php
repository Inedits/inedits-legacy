<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepageAction(Request $request)
    {
        $trees = $this->getDoctrine()->getRepository('AppBundle:Post')->getRootPost(3);

        foreach ($trees as $value)
        {
            $arrayTree[] = [
                'Tree'  => $value,
                'Users' => $this->getDoctrine()->getRepository('AppBundle:User')->findUsersByTree($value->getId(), 3),
            ];
        }

        $posts = $this->getDoctrine()->getRepository('AppBundle:Post')->getLastPost(3);

        foreach ($posts as $value)
        {
            $arrayPost[] = [
                'Tree'  => $value,
                'Users' => $this->getDoctrine()->getRepository('AppBundle:User')->findUsersByTree($value->getRoot()->getId(), 3),
            ];
        }

        $users = $this->getDoctrine()->getRepository('AppBundle:User')->findBestUsers(3);

        // replace this example code with whatever you need
        return $this->render('frontend/homepage.html.twig', [
            'trees' => $arrayTree,
            'posts' => $arrayPost,
            'users' => $users,
        ]);
    }
}
