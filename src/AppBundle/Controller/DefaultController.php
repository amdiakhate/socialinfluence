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
    public function indexAction(Request $request)
    {

        $twitter = $this->get('twitter_api_client');
        $twitter->get('1.1/followers/ids.json',array('user_id','justinbieber'));
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
        ]);
    }
}
