<?php

namespace GestionAccesBundle\Controller;

use GestionAccesBundle\Entity\Fonctionalite;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Fonctionalite controller.
 *
 */
class FonctionaliteController extends Controller
{
    /**
     * Lists all fonctionalite entities.
     *
     */
    public function indexAction()
    {
        if($this->get('session')->get('user')!=null) {
            $em = $this->getDoctrine()->getManager();

            $fonctionalites = $em->getRepository('GestionAccesBundle:Fonctionalite')->findAll();
            $Tid = 0;
            $router = $this->container->get('router');
            $admin=$this->get('session')->get('user');
            $routes = array();
            foreach ($router->getRouteCollection()->all() as $name => $route) {
                $routes[$name] = $route->compile();
            }
            $functions=$this->get('session')->get('functions');

            return $this->render('fonctionalite/index1.html.twig', array(
                'fonctionalites' => $fonctionalites,
                'Tid' => $Tid,
                'routes' => $routes,
                'functions' => $functions,
                'profil'=>$admin

            ));
        }
        else
        {
            return $this->redirectToRoute('utilisateur_cnx');
        }
    }

    /**
     * Creates a new fonctionalite entity.
     *
     */

    public function iconAction()
    {
        return $this->render('fonctionalite/icon.html.twig');
    }
    public function newAction(Request $request)
    {
        if ($request->isMethod('POST')) {

            $form=$request->request->all();
            $fonctionalite=new Fonctionalite();
            $fonctionalite->setNomFN($form['Tfnadd']);
            $fonctionalite->setDescription($form['Tdescadd']);
            $fonctionalite->setIcon($form['Tfniconadd']);
            $fonctionalite->setRouteid($form['lrouteadd']);
            $em = $this->getDoctrine()->getManager();
            $em->persist($fonctionalite);
            $em->flush();

            return $this->redirectToRoute('fonctionalite_index');
        }
    }

    /**
     * Finds and displays a fonctionalite entity.
     *
     */
    public function showAction(Fonctionalite $fonctionalite)
    {
        $deleteForm = $this->createDeleteForm($fonctionalite);

        return $this->render('fonctionalite/show.html.twig', array(
            'fonctionalite' => $fonctionalite,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing fonctionalite entity.
     *
     */
    public function editAction(Request $request, Fonctionalite $fonctionalite)
    {


        if ($request->isMethod('POST')) {

            $form=$request->request->all();
            $fonctionalite->setNomFN($form['Tfn']);
            $fonctionalite->setDescription($form['Tdesc']);
            $fonctionalite->setRouteid($form['lroute']);
            $fonctionalite->setIcon($form['Tfnicon']);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('fonctionalite_index');
        }

      /*  return $this->render('fonctionalite/edit.html.twig', array(
            'fonctionalite' => $fonctionalite,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));*/
    }

    /**
     * Deletes a fonctionalite entity.
     *
     */
    public function deleteAction(Request $request, Fonctionalite $fonctionalite)
    {


            $em = $this->getDoctrine()->getManager();
            $em->remove($fonctionalite);
            $em->flush();


        return $this->redirectToRoute('fonctionalite_index');
    }

    /**
     * Creates a form to delete a fonctionalite entity.
     *
     * @param Fonctionalite $fonctionalite The fonctionalite entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Fonctionalite $fonctionalite)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('fonctionalite_delete', array('id' => $fonctionalite->getIdFN())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
