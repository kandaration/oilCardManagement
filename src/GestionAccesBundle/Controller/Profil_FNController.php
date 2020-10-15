<?php

namespace GestionAccesBundle\Controller;

use GestionAccesBundle\Entity\Fonctionalite;
use GestionAccesBundle\Entity\Profil_FN;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\Mapping\ClassMetadata;

/**
 * Profil_fn controller.
 *
 */
class Profil_FNController extends Controller
{
    /**
     * Lists all profil_FN entities.
     *
     */
    public function indexAction()
    {
        if($this->get('session')->get('user')!=null) {
            $em = $this->getDoctrine()->getManager();

            $profil_FNs = $em->getRepository('GestionAccesBundle:Profil_FN')->findAll();
            $profils = $em->getRepository('GestionAccesBundle:Profil')->findAll();
            $functs = $em->getRepository('GestionAccesBundle:Fonctionalite')->findAll();
            $functions=$this->get('session')->get('functions');
            $admin=$this->get('session')->get('user');
            return $this->render('profil_fn/index1.html.twig', array(
                'profil_FNs' => $profil_FNs,
                'profils' => $profils,
                'functs' => $functs,
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
     * Creates a new profil_FN entity.
     *
     */
    public function newAction(Request $request)
    {
        $profil_FN = new Profil_fn();
        $form = $this->createForm('GestionAccesBundle\Form\Profil_FNType', $profil_FN);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($profil_FN);
            $em->flush($profil_FN);

            return $this->redirectToRoute('profilfn_show', array('id' => $profil_FN->getIdPFN()));
        }

        return $this->render('profil_fn/new.html.twig', array(
            'profil_FN' => $profil_FN,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a profil_FN entity.
     *
     */
    public function showAction(Profil_FN $profil_FN)
    {
        $deleteForm = $this->createDeleteForm($profil_FN);

        return $this->render('profil_fn/show.html.twig', array(
            'profil_FN' => $profil_FN,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing profil_FN entity.
     *
     */
    public function editAction(Request $request, Profil_FN $profil_FN)
    {
        $deleteForm = $this->createDeleteForm($profil_FN);
        $editForm = $this->createForm('GestionAccesBundle\Form\Profil_FNType', $profil_FN);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('profilfn_edit', array('id' => $profil_FN->getIdPFN()));
        }

        return $this->render('profil_fn/edit.html.twig', array(
            'profil_FN' => $profil_FN,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a profil_FN entity.
     *
     */
    public function deleteAction(Request $request, Profil_FN $profil_FN)
    {
        $form = $this->createDeleteForm($profil_FN);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($profil_FN);
            $em->flush();
        }

        return $this->redirectToRoute('profilfn_index');
    }
    public function  affectAction(Request $request)
    {
        $form=$request->request->all();
        $funcs=explode(',',$form['profil_fn']);
        $em=$this->getDoctrine()->getManager();
      //  $names= $em->getClassMetadata('GestionAccesBundle:Profil_FN')->getAssociationNames();
       $lprofil_func = $em->getRepository('GestionAccesBundle:Profil_FN')->findBy(array('profil_fn' => $funcs[count($funcs)-1]));
        $profil=$em->getRepository('GestionAccesBundle:Profil')->find($funcs[count($funcs)-1]);
        //$lprofil_func =$profil->getFunctions();
        foreach ($lprofil_func as $pfn)
        {
            $em->remove($pfn);
            $em->flush();
        }




        for($i=0;$i<=count($funcs)-2;$i++)
        {
            $func=$em->getRepository('GestionAccesBundle:Fonctionalite')->find($funcs[$i]);
            $newpfn=new Profil_FN();
            $newpfn->setProfilFn($profil);
            $newpfn->setFn($func);
            $em->persist($newpfn);
            $em->flush($newpfn);

        }

      return $this->redirectToRoute('profilfn_index');
    }

    /**
     * Creates a form to delete a profil_FN entity.
     *
     * @param Profil_FN $profil_FN The profil_FN entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Profil_FN $profil_FN)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('profilfn_delete', array('id' => $profil_FN->getIdPFN())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
