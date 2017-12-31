<?php

namespace MH\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MHUserBundle:Default:index.html.twig');
    }
}
