<?php

namespace GestionAccesBundle\Controller;

use GestionAccesBundle\Entity\Utilisateur;
use GestionAccesBundle\GestionAccesBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Utilisateur controller.
 *
 */
class UtilisateurController extends Controller
{
    /**
     * Lists all utilisateur entities.
     *
     */
    public function indexAction()
    {
        if($this->get('session')->get('user')!=null){

        $admin=$this->get('session')->get('user');
        $em = $this->getDoctrine()->getManager();
        $functions=$this->get('session')->get('functions');

        $utilisateurs = $em->getRepository('GestionAccesBundle:Utilisateur')->findAll();



        return $this->render('utilisateur/index2.html.twig', array(
            'utilisateurs' => $utilisateurs,
            'functions' => $functions,
            "profil"=>$admin,

        ));
        }
        else
        {
            return $this->redirectToRoute('utilisateur_cnx');
        }
    }

    /**
     * Creates a new utilisateur entity.
     *
     */
    public function newPAction(Request $request)
    {
        if ($request->isMethod('POST')) {
            //$postData = $request->request->attributes;
            //$test=$request->request->get('xxx')['Tlogin'];
            // $testall=$request->request->get("xxx");
            //  $testtel=$request->request->get("xxx")['Ttel'];
            //  $testnom=$request->request->get("xxx")['Tnom'];

            $from=$request->request->all();
            $da=date_create_from_format('d/m/Y',$from['date_naissanceadd']);
            $date_naiss=date_format($da,'m/d/Y');

            $carte = $this->getDoctrine()->getManager()->getRepository('GestionCarteBundle:Carte')->find($from['Tnum_carte']);
            $clt = $this->getDoctrine()->getManager()->getRepository('GestionCarteBundle:Client')->find($from['Tid_clt']);

            $utilisateur=new Utilisateur();
            $utilisateur->setLogin($from['Tloginadd']);
            $utilisateur->setEmail($from['Tmailadd']);
            $utilisateur->setNom($from['Tnomadd']);
            $utilisateur->setPrenom($from['Tprenomadd']);
            $utilisateur->setDateNaissance( new \DateTime($date_naiss));
            $utilisateur->setMotPasse($from['Tpassadd']);
            $utilisateur->setTel($from['Tteladd']);
            $utilisateur->setCarte($carte);
            $utilisateur->setType(2);
            $carte->setClient($clt);
            $em = $this->getDoctrine()->getManager();
            $em->persist($utilisateur);
            $em->flush($utilisateur);
            $em->flush($carte);

            $myappContactMail = 'kandara@sace.tn';
            $recivermail=$from['Tmailadd'];


            $message = \Swift_Message::newInstance("Coordonnée du Compte du Portail carte pétrolière ")
                ->setFrom(array($myappContactMail => 'Portail carte pétrolière'))
                ->setTo(array(
                    $recivermail => $recivermail
                ))
                ->setBody("Cher M/Mme ".$from['Tnomadd'].", \n nous avons le plaisir de vous informer que votre compte\n"

               ."au sien de notre portail a était crèer par notre équipe technique. \n"
                ."Et vous pouvez vous connecter et suivre l'activité de vos cartes en utlisant les coordonnée du compte mentioné ci-dessous:\n"
                ."Login: <b>".$from['Tloginadd']."</b>\n"
                ."Mot de passe: <b>".$from['Tpassadd']."</b>\n"
                ."NB: Ces données sont confidentielles prière de les conserver secretes\n"
                ."-----------------------------------\n"
                ."cordialement l'équipe technique");
            $this->get('mailer')->send($message);

            return $this->redirectToRoute('utilisateur_index');
        }

        //return $this->render('utilisateur/new1.html.twig');
    }


    public function newGAction(Request $request)
    {
        if ($request->isMethod('POST')) {
            //$postData = $request->request->attributes;
            //$test=$request->request->get('xxx')['Tlogin'];
            // $testall=$request->request->get("xxx");
            //  $testtel=$request->request->get("xxx")['Ttel'];
            //  $testnom=$request->request->get("xxx")['Tnom'];

            $from=$request->request->all();
            $da=date_create_from_format('d/m/Y',$from['date_naissanceadd']);
            $date_naiss=date_format($da,'m/d/Y');

            $gerant= $this->getDoctrine()->getManager()->getRepository('GestionCarteBundle:Gerant')->find($from['Tid_gerant']);


            $utilisateur=new Utilisateur();
            $utilisateur->setLogin($from['Tloginadd']);
            $utilisateur->setEmail($from['Tmailadd']);
            $utilisateur->setNom($from['Tnomadd']);
            $utilisateur->setPrenom($from['Tprenomadd']);
            $utilisateur->setDateNaissance( new \DateTime($date_naiss));
            $utilisateur->setMotPasse($from['Tpassadd']);
            $utilisateur->setTel($from['Tteladd']);
            $utilisateur->setCompteGerant($gerant);
            $utilisateur->setType(1);
            $em = $this->getDoctrine()->getManager();
            $em->persist($utilisateur);
            $em->flush($utilisateur);

            $myappContactMail = 'kandara@sace.tn';
            $recivermail=$from['Tmailadd'];


            $message = \Swift_Message::newInstance("Coordonnée du Compte du Portail carte pétrolière ")
                ->setFrom(array($myappContactMail => 'Portail carte pétrolière'))
                ->setTo(array(
                    $recivermail => $recivermail
                ))
                ->setBody("Cher M/Mme ".$from['Tnomadd'].", \n nous avons le plaisir de vous informer que votre compte\n"

                    ."au sien de notre portail a était crèer par notre équipe technique. \n"
                    ."Et vous pouvez vous connecter et suivre l'activité de vos cartes en utlisant les coordonnée du compte mentioné ci-dessous:\n"
                    ."Login: <b>".$from['Tloginadd']."</b>\n"
                    ."Mot de passe: <b>".$from['Tpassadd']."</b>\n"
                    ."NB: Ces données sont confidentielles prière de les conserver secretes\n"
                    ."-----------------------------------\n"
                    ."cordialement l'équipe technique");
            $this->get('mailer')->send($message);

            return $this->redirectToRoute('utilisateur_index');
        }

        //return $this->render('utilisateur/new1.html.twig');
    }

    public function newCAction(Request $request)
    {
        if ($request->isMethod('POST')) {
            //$postData = $request->request->attributes;
            //$test=$request->request->get('xxx')['Tlogin'];
            // $testall=$request->request->get("xxx");
            //  $testtel=$request->request->get("xxx")['Ttel'];
            //  $testnom=$request->request->get("xxx")['Tnom'];

            $from=$request->request->all();
            $da=date_create_from_format('d/m/Y',$from['date_naissanceadd']);
            $date_naiss=date_format($da,'m/d/Y');

            $clt = $this->getDoctrine()->getManager()->getRepository('GestionCarteBundle:Client')->find($from['Tid_client']);


            $utilisateur=new Utilisateur();
            $utilisateur->setLogin($from['Tloginadd']);
            $utilisateur->setEmail($from['Tmailadd']);
            $utilisateur->setNom($from['Tnomadd']);
            $utilisateur->setPrenom($from['Tprenomadd']);
            $utilisateur->setDateNaissance( new \DateTime($date_naiss));
            $utilisateur->setMotPasse($from['Tpassadd']);
            $utilisateur->setTel($from['Tteladd']);
            $utilisateur->setTel($from['Tid_client']);
            $utilisateur->setType(0);
            $em = $this->getDoctrine()->getManager();
            $em->persist($utilisateur);
            $em->flush($utilisateur);

            $myappContactMail = 'kandara@sace.tn';
            $recivermail=$from['Tmailadd'];


            $message = \Swift_Message::newInstance("Coordonnée du Compte du Portail carte pétrolière ")
                ->setFrom(array($myappContactMail => 'Portail carte pétrolière'))
                ->setTo(array(
                    $recivermail => $recivermail
                ))
                ->setBody("Cher M/Mme ".$from['Tnomadd'].", \n nous avons le plaisir de vous informer que votre compte\n"

                    ."au sien de notre portail a était crèer par notre équipe technique. \n"
                    ."Et vous pouvez vous connecter et suivre l'activité de vos cartes en utlisant les coordonnée du compte mentioné ci-dessous:\n"
                    ."Login: <b>".$from['Tloginadd']."</b>\n"
                    ."Mot de passe: <b>".$from['Tpassadd']."</b>\n"
                    ."NB: Ces données sont confidentielles prière de les conserver secretes\n"
                    ."-----------------------------------\n"
                    ."cordialement l'équipe technique");
            $this->get('mailer')->send($message);

            return $this->redirectToRoute('utilisateur_index');
        }

        //return $this->render('utilisateur/new1.html.twig');
    }

    /**
     * Finds and displays a utilisateur entity.
     *
     */
    public function showAction(Utilisateur $utilisateur)
    {
        $deleteForm = $this->createDeleteForm($utilisateur);
        $admin=$this->get('session')->get('user');
        return $this->render('utilisateur/show1.html.twig', array(
            'utilisateur' => $utilisateur,
            'delete_form' => $deleteForm->createView(),
            'profil'=>$admin
        ));
    }

    public function homepageAction()
    {

        return $this->render('utilisateur/Acceuil.html.twig');

    }

    /**
     * Displays a form to edit an existing utilisateur entity.
     *
     */
    public function editAction(Request $request, Utilisateur $utilisateur)
    {



        if ($request->isMethod('POST')) {
            //$postData = $request->request->attributes;
            //$test=$request->request->get('xxx')['Tlogin'];
           // $testall=$request->request->get("xxx");
          //  $testtel=$request->request->get("xxx")['Ttel'];
          //  $testnom=$request->request->get("xxx")['Tnom'];
            $from=$request->request->all();
           $mail=$from['Tmail'];

           var_dump($from);
          //  $test= \DateTime::createFromFormat('m-d-Y', $from['date_naissance']);

            //$date_naiss=$test->format('d-m-Y');
           // var_dump($test);
            $da=date_create_from_format('d/m/Y',$from['date_naissance']);
            $date_naiss=date_format($da,'m/d/Y');
         $utilisateur->setEmail($from['Tmail']);
         $utilisateur->setNom($from['Tnom']);
            $utilisateur->setPrenom($from['Tprenom']);
            $utilisateur->setDateNaissance( new \DateTime($date_naiss));
            $utilisateur->setMotPasse($from['Tpass']);
            $utilisateur->setTel($from['Ttel']);
            $em = $this->getDoctrine()->getManager();
            $em->flush();


            return $this->redirectToRoute('utilisateur_index');
        }

     /*  return $this->render('utilisateur/edit1.html.twig', array(
            'utilisateur' => $utilisateur,
        ));*/
    }

    /**
     * Deletes a utilisateur entity.
     *
     */




    public function deconnexionAction()
    {
        if($this->get('session')->get('user')!=null)
        {
            $this->get('session')->set('user',null) ;

        }
        return $this->redirectToRoute('projet_homepage');
    }

    public function cnxAction(Request $request)
    {
        if ($request->isMethod('POST')) {
            $form=$request->request->all();

            $em = $this->getDoctrine()->getManager();
            $utilsateur = $em->getRepository('GestionAccesBundle:Utilisateur')->findOneBy(array('login'=>$form['username']));
            if($utilsateur!=null)
            {
                if($form['pwd']==$utilsateur->getMotPasse())
                {

                    $roles = $em->getRepository('GestionAccesBundle:ProfilUtilisateur')->findBy(array('utilisateur' => $utilsateur->getIdUtilisateur()));
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
                        $x=$functions[$i]->getNomFN();
                        $i++;
                    }
                    $fn=$functions[0]->getNomFN();

                    $this->get('session')->set('user',$utilsateur);

                   $this->get('session')->set('functions', $functions);
                   $fntest=$this->get('session')->get('functions');

                 if($utilsateur->getType()==0){
                     return $this->redirectToRoute("reporting_C");
                 }
                 elseif ($utilsateur->getType()==1)
                 {
                     return $this->redirectToRoute("reporting_G");
                 }
                 elseif ($utilsateur->getType()==2)
                 {
                     return $this->redirectToRoute("reporting_P");
                 }
                 else
                 {
                     return $this->redirectToRoute("utilisateur_index");
                 }

                }
                else
                {
                    $user=null;
                    return $this->render('utilisateur/connexion.html.twig', array(
                        'utilisateur' => $user));
                }
            }
            else
            {
                $user=null;
                return $this->render('utilisateur/connexion.html.twig', array(
                    'utilisateur' => $user));
            }




        }


            return $this->render('utilisateur/connexion.html.twig');

    }


    public function deleteAction(Request $request, Utilisateur $utilisateur)
    {
        //$form = $this->createDeleteForm($utilisateur);
       // $form->handleRequest($request);

        //if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($utilisateur);
            $em->flush();
        //}

        return $this->redirectToRoute('utilisateur_index');
    }
    public function testAction()
    {
        $em = $this->getDoctrine()->getManager();
        $utilisateur=$em->getRepository('GestionAccesBundle:Utilisateur')->find(5);

        return $this->render('utilisateur/edit1.html.twig', array(
            'utilisateur' => $utilisateur,
        ));
    }
    /**
     * Creates a form to delete a utilisateur entity.
     *
     * @param Utilisateur $utilisateur The utilisateur entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Utilisateur $utilisateur)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('utilisateur_delete', array('id' => $utilisateur->getIdUtilisateur())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
