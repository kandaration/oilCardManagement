<?php

namespace ReportingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ReportingBundle:Default:index.html.twig');
    }
}
