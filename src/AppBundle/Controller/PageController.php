<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PageController extends Controller
{
    /**
     * @Route("/page/{page}", name="page_display")
     * @Method({"GET"})
     */
    public function DisplayAction(Request $request, $page)
    {
        $page = htmlspecialchars($page);

        if ( !$this->get('templating')->exists('page/comment-ca-marche.html.twig') ) {
             exit('fuck');
        }

        return $this->render('page/'.$page.'.html.twig');
    }
}
