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

class MailingController extends Controller
{
    /**
     * @Route("/recommandation", name="mailing_add")
     * @Method({"GET", "POST"})
     */
    public function AddAction(Request $request)
    {
        $user = $this->getUser();
        $form = $this->createForm(
            new MailingType([
                'action' => $this->generateUrl('mailing_add', [], true),
            ]),
            new Mailing()
        );
        $mailer = $this->get('mailer');

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mailing = $form->getData();
            $dupe    = $this->getDoctrine()->getRepository('AppBundle:Mailing')->findOneByMail($mailing->getMail());
            $exist   = $this->getDoctrine()->getRepository('AppBundle:User')->findOneByEmail($mailing->getMail());

            if ($dupe) {
                $this->get('session')->getFlashBag()->add('danger', 'Cette adresse a déjà été sollicitées');
                $referer = $request->headers->get('referer');

                return $this->redirect($referer);
            }
            if ($exist) {
                $this->get('session')->getFlashBag()->add('danger', 'Cette adresse est déjà inscrite sur notre site');
                $referer = $request->headers->get('referer');

                return $this->redirect($referer);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($mailing);
            $em->flush();

            // Emails
            $message = $mailer->createMessage()
                ->setSubject('Inedit | La première plateforme d\'écriture collaborative')
                ->setFrom('clemence@inedits.fr', 'Inedit | La première plateforme d\'écriture collaborative')
                ->setTo([$mailing->getMail()])
                ->setBody(
                    $this->render(
                        'email/mailing_add.html.twig',
                        [
                            'user' => $user,
                        ]
                    ),
                    'text/html'
                )
            ;
            $mailer->send($message);

            $this->get('session')->getFlashBag()->add('success', 'Merci de votre aide');
            $referer = $request->headers->get('referer');
        }

        $referer = $request->headers->get('referer');

        return $this->redirect($referer);
    }
}
