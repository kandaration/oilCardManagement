<?php

namespace GestionCarteBundle\Controller;


use GestionTransactionBundle\Entity\Transaction;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class GestionCarteController extends Controller
{
    public function indexAction()
    {
        $user=$this->get('session')->get('user');
        if($user!=null)
        {
            $em = $this->getDoctrine()->getManager();
            $cartes=array();
            $carte_principal=null;
            $clt=null;
            if($user->getType()==0)
            {
                $cartes = $em->getRepository('GestionCarteBundle:Carte')->findBy(array('client' => $user->getCompteClt()));


                usort($cartes, function(\GestionCarteBundle\Entity\Carte $object1, \GestionCarteBundle\Entity\Carte  $object2)
                {

                    return  $object1->getNomPorteur()<= $object2->getNomPorteur() ? -1 : 1;
                });
                $carte_principal=$cartes[0];
                    $clt=$em->getRepository('GestionCarteBundle:Client')->find($user->getCompteClt()->getIdClient());
                   $d=$clt->getDesignation();
            }
            else if($user->getType()==2)
            {
                $cartes = $em->getRepository('GestionCarteBundle:Carte')->findAllByPorteur($user->getCarte());
                $carte_principal=$em->getRepository('GestionCarteBundle:Carte')->find($user->getCarte());
                $user_info=$user;

            }
            $functions=$this->get('session')->get('functions');

            return $this->render('Cartes/index.html.twig',array(
                'cartes'=>$cartes,
                'nbr_carte'=>count($cartes),
                'carte_principal'=>$carte_principal,
                'profil'=>$user,
                'type'=>$user->getType(),
                'functions' => $functions,
                "clt"=>$clt
            ));

        }
        return $this->render('utilisateur/connexion.html.twig');
    }

    public function TrshiftAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user=$this->get('session')->get('user');
        $num_carte=$request->get('num_carte');
        $transactions=$em->getRepository('GestionTransactionBundle:Transaction')->findShiftTrCarte($num_carte);


        $json=new JsonResponse(json_encode($transactions));
        return $json;

    }
    public function CarteStatAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user=$this->get('session')->get('user');
        $num_carte=$request->get('num_carte');
        $carte=$em->getRepository('GestionCarteBundle:Carte')->find($num_carte);


        $json=new JsonResponse(json_encode($carte));
        return $json;

    }
    public function BlockCarteAction(Request $request)
    {
        $num_carte=$request->get('num_carte');
        $carte=$this->getDoctrine()->getManager()->getRepository('GestionCarteBundle:Carte')->find($num_carte);
        $carte->setEtat("désactivé");
        $this->getDoctrine()->getManager()->flush();
        return new JsonResponse();

    }
    public function trsfrtAction(Request $request)
    {
        $num_carte=$request->get('num_carte');
        $num_carteb=$request->get('num_carteb');
        $montant=$request->get('montant');
        $code=$request->get('code');
        $em = $this->getDoctrine()->getManager();
        $carte=$em->getRepository('GestionCarteBundle:Carte')->find($num_carte);
        $carteb=$em->getRepository('GestionCarteBundle:Carte')->find($num_carteb);
        $x=$carte->getSolde();
        if($carteb!=null) {
            if ($carte->getCode() == $code) {
                if ($carte->getSolde() > $montant) {
                    if ($carteb->getSolde() + $montant < $carteb->getPlafond()) {
                        $lastTr = $em->getRepository("GestionTransactionBundle:Transaction")->findOneBy(
                            array(),
                            array('id_transaction' => 'DESC')
                        )->getIdTransaction();
                        $type4 = $em->getRepository('GestionTransactionBundle:Type_Transaction')->find(4);
                        $type1 = $em->getRepository('GestionTransactionBundle:Type_Transaction')->find(1);
                        $tpe = $em->getRepository('GestionTransactionBundle:TPE')->find(-1);
                        $terminl = $em->getRepository('GestionTransactionBundle:Terminal')->find(-1);
                        $station = $em->getRepository('GestionCarteBundle:Station')->find(-1);

                        if ($carte->getClient() != null) {
                            $clt = $carte->getClient();
                            $clt->getAdress();
                        } else {
                            $clt = $em->getRepository('GestionCarteBundle:Client')->find(-1);
                        }

                        $date = new \DateTime('now');
                        $TrFrom = new Transaction();
                        $TrTo = new Transaction();
                        $h = date_format($date, 'H:i:s');
                        $d = date_format($date, 'Y-m-d');

                        $TrFrom->setIdTransaction(intval($lastTr) + 1);
                        $TrFrom->setCarte($carte);
                        $TrFrom->setNumTicket("-1");
                        $TrFrom->setMontant($montant);
                        $TrFrom->setType($type4);
                        $TrFrom->setSolde($carte->solde - $montant);
                        $TrFrom->setHeure(new \DateTime($h));
                        $TrFrom->setDate(new \DateTime($d));
                        $TrFrom->setTpe($tpe);
                        $TrFrom->setTerminal($terminl);
                        $TrFrom->setStation($station);
                        $TrFrom->setClient($clt);

                        if ($carte->getClient() != null) {
                            $clt = $carte->getClient();
                            $clt->getAdress();
                        } else {
                            $clt = $em->getRepository('GestionCarteBundle:Client')->find(-1);
                        }

                        $TrTo->setIdTransaction(intval($lastTr) + 2);
                        $TrTo->setCarte($carteb);
                        $TrTo->setNumTicket("-1");
                        $TrTo->setMontant($montant);
                        $TrTo->setType($type1);
                        $TrTo->setSolde($carte->solde + $montant);
                        $TrTo->setHeure(new \DateTime($h));
                        $TrTo->setDate(new \DateTime($d));
                        $TrTo->setTpe($tpe);
                        $TrTo->setTerminal($terminl);
                        $TrTo->setStation($station);
                        $TrTo->setClient($clt);


                        $em->persist($TrFrom);
                        $em->flush();
                        $em->persist($TrTo);
                        $em->flush();
                        $carte->setSolde($carte->solde - $montant);
                        $em->flush();
                        $carteb->setSolde($carteb->solde + $montant);
                        $em->flush();

                        return new JsonResponse("success");
                    } else {
                        return new JsonResponse("plafond");
                    }
                } else {
                    return new JsonResponse("solde");
                }
            } else {
                return new JsonResponse("code");
            }
        }
        else
        {
            return new JsonResponse("carte");
        }

    }

    public function carteInfoAction(Request $request)
    {
        $num_carte=$request->get('num_carte');
        $em = $this->getDoctrine()->getManager();
        $carte=$em->getRepository('GestionCarteBundle:Carte')->find($num_carte);
        $rep=array("solde"=>$carte->getSolde(),"plafond"=>$carte->getPlafond());
        return new JsonResponse($rep);
    }

    public function EntrepriseInfoAction(Request $request)
    {
        $id_clt=$request->get('id_clt');
        $em = $this->getDoctrine()->getManager();
        $clt=$em->getRepository('GestionCarteBundle:Client')->find($id_clt);
        $cartes=$em->getRepository('GestionCarteBundle:Carte')->findby(array("client"=>$id_clt));
        $solde=0;
        foreach ($cartes as $carte)
        {
            $solde=$solde+$carte->getSolde();
        }
        $rep=array("solde"=>$solde,"plafond"=>$clt->getPlafondcredit());
        return new JsonResponse($rep);
    }
}
