<?php

namespace GestionAccesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('session')->get('user');
        $roles = $em->getRepository('GestionAccesBundle:ProfilUtilisateur')->findBy(array('utilisateur' => $user->getIdUtilisateur()));
           $test=0;
        foreach ($roles as $rol) {
            $test = $rol;
            $test = $rol->getProfil()->getIdProfil();


        }
        $fonctionalites = $em->getRepository('GestionAccesBundle:Profil_FN')->findBy(array('profil_fn' => $test));
        $i = 0;

        $functions = array();
       foreach ($fonctionalites as $funcs) {
            $functions[$i] = $em->getRepository('GestionAccesBundle:Fonctionalite')->find($funcs->getFn());
            //$x=$functions[$i]->getNomFN();
            $i++;
        }

        //$fn=$functions[0]->getNomFN();
        $router = $this->container->get('router');

        $routes = array();
        foreach ($router->getRouteCollection()->all() as $name => $route) {
            $routes[$name] = $route->compile();
        }
        $this->get('session')->set('functions', $functions);
        $functionss=$this->get('session')->get('functions');
        return $this->render('GestionAccesBundle:Default:index.html.twig', array(
            'functions' => $functionss,
            'routes' => $routes,
            'func' => $functions
        ));
        // return $this->render('GestionAccesBundle:Default:index.html.twig');
    }
}
