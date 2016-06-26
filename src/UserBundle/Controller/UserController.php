<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\Network;
use UserBundle\Form\NetworkType;
use Abraham\TwitterOAuth\TwitterOAuth;
use UserBundle\Form\UserType;
use UserBundle\UserBundle;

define('OAUTH_CALLBACK', getenv('OAUTH_CALLBACK'));

class UserController extends Controller
{
    public function indexAction()
    {
        return $this->render('UserBundle:Default:index.html.twig');
    }

    public function showProfileAction()
    {
        $user = $this->getUser();

        return $this->render('UserBundle:Profile:show.html.twig', array(
            'user' => $user
        ));
    }

    public function editProfileAction()
    {
        $user = $this->getUser();
        $form = $this->createForm(new UserType(), $user);

        return $this->render('UserBundle:Profile:edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listNetworksAction()
    {
        $user = $this->getUser();
        $networks = $user->getNetworks();

        /**
         * @var $network Network
         */
        foreach ($networks as $network) {
            if ($network->getType() == 'twitter') {
                $connection = $network->getConnection($this->getParameter('consumer_key'), $this->getParameter('consumer_secret'));
                $user = $connection->get("account/verify_credentials");
            }
        }
        return $this->render('UserBundle:Network:list.html.twig', array(
            'networks' => $networks
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addNetworkAction(Request $request)
    {
        return $this->render('UserBundle:Network:add.html.twig');
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Abraham\TwitterOAuth\TwitterOAuthException
     */
    public function addTwitterAction(Request $request)
    {
        if ($request->query->get('oauth_token') && $request->query->get('oauth_verifier')) {
            $connection = new TwitterOAuth(
                $this->getParameter('consumer_key'),
                $this->getParameter('consumer_secret'),
                $_SESSION['oauth_token'],
                $_SESSION['oauth_token_secret']
            );
            $oauthVerifier = $request->query->get('oauth_verifier');
            $access_token = $connection->oauth("oauth/access_token", array(
                    "oauth_verifier" => $oauthVerifier
                )
            );
            $network = new Network();
            $network->setUsername($access_token['screen_name']);
            $network->setNetworkUserId($access_token['user_id']);
            $network->setAccessToken($access_token['oauth_token']);
            $network->setAccessTokenSecret($access_token['oauth_token_secret']);
            $network->setType('twitter');
            $network->setUser($this->getUser());

            $em = $this->getDoctrine()->getManager();
            $em->persist($network);
            $em->flush();

            return $this->redirect($this->generateUrl('user_addNetwork'));

        } else {
            $connection = new TwitterOAuth($this->getParameter('consumer_key'), $this->getParameter('consumer_secret'));
            $request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));
            $twitterUrl = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
            $_SESSION['oauth_token'] = $request_token['oauth_token'];
            $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
            return $this->redirect($twitterUrl);
        }

    }
}
