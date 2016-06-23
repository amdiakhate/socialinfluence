<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\Network;
use UserBundle\Form\NetworkType;
use Abraham\TwitterOAuth\TwitterOAuth;

define('OAUTH_CALLBACK', getenv('OAUTH_CALLBACK'));

class UserController extends Controller
{
    public function indexAction()
    {
        return $this->render('UserBundle:Default:index.html.twig');
    }

    public function addNetworkAction(Request $request)
    {
        $connection = new TwitterOAuth($this->getParameter('consumer_key'), $this->getParameter('consumer_secret'));
        $request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));

        $url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
//        echo $url;
        return $this->redirect($url);

//        $network = new Network();
//        $form = $this->createForm(NetworkType::class,$network);
//
//        $form->handleRequest($request);
//        if($form->isSubmitted() && $form->isValid())
//        {
//            $em = $this->getDoctrine()->getManager();
//            $network->setUser($this->getUser());
//            $em->persist($network);
//            $em->flush();
//
//        }
//
//        return $this->render('UserBundle:Network:add.html.twig',array(
//            'form'=>$form->createView()
//        ));
    }
}
