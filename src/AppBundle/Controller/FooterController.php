<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Mailing;
use AppBundle\Form\Type\MailingType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class FooterController extends Controller
{
    /**
     * @Route("/mailing/formulaire", name="mailing_form")
     */
    public function getFooterAction(Request $request)
    {
        $form = $this->createForm(
            new MailingType(),
            new Mailing(),
            [
                'action' => $this->generateUrl('mailing_add', [], true),
            ]
        );

        return $this->render('footer\_mailing_form.html.twig', ['form' => $form->createView()]);
    }
}
