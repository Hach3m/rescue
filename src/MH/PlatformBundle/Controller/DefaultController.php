<?php

namespace MH\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MHPlatformBundle:Default:index.html.twig');
    }
}
