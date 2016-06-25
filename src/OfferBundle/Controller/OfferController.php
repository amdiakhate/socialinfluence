<?php

namespace OfferBundle\Controller;

use OfferBundle\Entity\Offer;
use OfferBundle\Form\OfferType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class OfferController extends Controller
{
    public function indexAction()
    {
        $offerRep = $this->getDoctrine()->getRepository('OfferBundle:Offer');
        $offers = $offerRep->findBy(array('user' => $this->getUser()));
        return $this->render('OfferBundle:Offer:list.html.twig', array(
            'offers' => $offers
        ));
    }

    public function addOfferAction(Request $request)
    {
        $offer = new Offer();
        $form = $this->createForm(new OfferType($this->getUser()), $offer);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $offer->setUser($this->getUser());
            $em->persist($offer);
            $em->flush();

            return $this->redirect($this->generateUrl('offer_homepage'));
        } else {
            return $this->render('OfferBundle:Offer:add.html.twig', array(
                'form' => $form->createView()
            ));
        }
    }
}
