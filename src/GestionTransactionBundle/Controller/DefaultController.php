<?php

namespace GestionTransactionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('GestionTransactionBundle:Default:index.html.twig');
    }
}
