<?php

namespace GestionAccesBundle\Controller;

use GestionAccesBundle\Entity\Profil;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Profil controller.
 *
 */
class ProfilController extends Controller
{
    /**
     * Lists all profil entities.
     *
     */
    public function indexAction()
    {
        if($this->get('session')->get('user')!=null) {
            $em = $this->getDoctrine()->getManager();
            $admin=$this->get('session')->get('user');
            $profils = $em->getRepository('GestionAccesBundle:Profil')->findAll();
            $functions=$this->get('session')->get('functions');
            return $this->render('profil/index1.html.twig', array(
                'profils' => $profils,
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
     * Creates a new profil entity.
     *
     */
    public function newAction(Request $request)
    {


        if ($request->isMethod("POST")) {
            $form=$request->request->all();
            $profil=new Profil();
            $profil->setNomProfil($form['Tprofiladd']);
            $profil->setDescription($form['Tdescadd']);
            $em = $this->getDoctrine()->getManager();
            $em->persist($profil);
            $em->flush($profil);

            return $this->redirectToRoute('profil_index');
        }


    }

    /**
     * Finds and displays a profil entity.
     *
     */
    public function showAction(Profil $profil)
    {
        $deleteForm = $this->createDeleteForm($profil);

        return $this->render('profil/show.html.twig', array(
            'profil' => $profil,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing profil entity.
     *
     */
    public function editAction(Request $request, Profil $profil)
    {


        if ($request->isMethod('POST'))  {
            $form=$request->request->all();
            $profil->setNomProfil($form['Tprofil']);
            $profil->setDescription($form['Tdesc']);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('profil_index');
        }


    }

    /**
     * Deletes a profil entity.
     *
     */
    public function deleteAction(Request $request, Profil $profil)
    {



            $em = $this->getDoctrine()->getManager();
            $em->remove($profil);
            $em->flush();

        return $this->redirectToRoute('profil_index');
    }

    /**
     * Creates a form to delete a profil entity.
     *
     * @param Profil $profil The profil entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Profil $profil)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('profil_delete', array('id' => $profil->getIdProfil())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
