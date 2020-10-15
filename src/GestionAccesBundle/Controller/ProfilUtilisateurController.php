<?php

namespace GestionAccesBundle\Controller;

use GestionAccesBundle\Entity\ProfilUtilisateur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Profilutilisateur controller.
 *
 */
class ProfilUtilisateurController extends Controller
{
    /**
     * Lists all profilUtilisateur entities.
     *
     */
    public function indexAction()
    {
        if($this->get('session')->get('user')!=null) {
            $em = $this->getDoctrine()->getManager();

            $admin=$this->get('session')->get('user');
            $profil_users = $em->getRepository('GestionAccesBundle:ProfilUtilisateur')->findAll();
            $profils = $em->getRepository('GestionAccesBundle:Profil')->findAll();
            $users = $em->getRepository('GestionAccesBundle:Utilisateur')->findAll();
            $functions=$this->get('session')->get('functions');
            return $this->render('profilutilisateur/index1.html.twig', array(
                'profil_users' => $profil_users,
                'profils' => $profils,
                'users' => $users,
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
     * Creates a new profilUtilisateur entity.
     *
     */
    public function newAction(Request $request)
    {
        $profilUtilisateur = new Profilutilisateur();
        $form = $this->createForm('GestionAccesBundle\Form\ProfilUtilisateurType', $profilUtilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($profilUtilisateur);
            $em->flush($profilUtilisateur);

            return $this->redirectToRoute('profiluser_show', array('id' => $profilUtilisateur->getId()));
        }

        return $this->render('profilutilisateur/new.html.twig', array(
            'profilUtilisateur' => $profilUtilisateur,
            'form' => $form->createView(),
        ));
    }

    public function  affectAction(Request $request)
    {
        $form=$request->request->all();
        $profils=explode(',',$form['profil_users']);
        $em=$this->getDoctrine()->getManager();
       // $names= $em->getClassMetadata('GestionAccesBundle:ProfilUtilisateur')->getAssociationNames();
        $lprofil_user = $em->getRepository('GestionAccesBundle:ProfilUtilisateur')->findBy(array('utilisateur' => $profils[count($profils)-1]));
        $user=$em->getRepository('GestionAccesBundle:Utilisateur')->find($profils[count($profils)-1]);
        //$lprofil_func =$profil->getFunctions();
       if(count($lprofil_user)>0)
       {
           foreach ($lprofil_user as $puser) {
               $em->remove($puser);
               $em->flush();
           }
       }



        for($i=0;$i<=count($profils)-2;$i++)
        {
            $profil=$em->getRepository('GestionAccesBundle:Profil')->find($profils[$i]);
            $newpuser=new ProfilUtilisateur();
            $newpuser->setUtilisateur($user);
            $newpuser->setProfil($profil);
            $em->persist($newpuser);
            $em->flush($newpuser);

        }

        return $this->redirectToRoute('profiluser_index');
    }

    /**
     * Finds and displays a profilUtilisateur entity.
     *
     */
    public function showAction(ProfilUtilisateur $profilUtilisateur)
    {
        $deleteForm = $this->createDeleteForm($profilUtilisateur);

        return $this->render('profilutilisateur/show.html.twig', array(
            'profilUtilisateur' => $profilUtilisateur,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing profilUtilisateur entity.
     *
     */
    public function editAction(Request $request, ProfilUtilisateur $profilUtilisateur)
    {
        $deleteForm = $this->createDeleteForm($profilUtilisateur);
        $editForm = $this->createForm('GestionAccesBundle\Form\ProfilUtilisateurType', $profilUtilisateur);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('profiluser_edit', array('id' => $profilUtilisateur->getId()));
        }

        return $this->render('profilutilisateur/edit.html.twig', array(
            'profilUtilisateur' => $profilUtilisateur,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a profilUtilisateur entity.
     *
     */
    public function deleteAction(Request $request, ProfilUtilisateur $profilUtilisateur)
    {
        $form = $this->createDeleteForm($profilUtilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($profilUtilisateur);
            $em->flush();
        }

        return $this->redirectToRoute('profiluser_index');
    }

    /**
     * Creates a form to delete a profilUtilisateur entity.
     *
     * @param ProfilUtilisateur $profilUtilisateur The profilUtilisateur entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProfilUtilisateur $profilUtilisateur)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('profiluser_delete', array('id' => $profilUtilisateur->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
