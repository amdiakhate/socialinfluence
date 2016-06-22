<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserBundle\Entity\Network;
use UserBundle\Form\NetworkType;

class UserController extends Controller
{
    public function indexAction()
    {
        return $this->render('UserBundle:Default:index.html.twig');
    }

    public function addNetworkAction()
    {
        $network = new Network();
        $form = $this->createForm(NetworkType::class,$network);
        
        return $this->render('UserBundle:Network:add.html.twig',array(
            'form'=>$form->createView()
        ));
    }
}
