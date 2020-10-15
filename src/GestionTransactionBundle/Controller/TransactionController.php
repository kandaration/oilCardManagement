<?php

namespace GestionTransactionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use GestionTransactionBundle\Entity\Transaction;


class TransactionController extends Controller
{
    public function indexAction(Request $request)
    {
        if ($this->get('session')->get('user') != null) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->get('session')->get('user');
            $num_carte = $request->request->get('id');
            $transactions = $em->getRepository('GestionTransactionBundle:Transaction')->findBy(array('carte' => $num_carte));
            $clt = null;
            if ($user->getType() == 0) {
                $clt = $em->getRepository('GestionCarteBundle:Client')->find($user->getCompteClt()->getIdClient());
                $d = $clt->getDesignation();
            }

            usort($transactions, function (\GestionTransactionBundle\Entity\Transaction $object1, \GestionTransactionBundle\Entity\Transaction $object2) {

                if ($object1->getDate() == $object2->getDate()) {
                    return $object1->getHeure() <= $object2->getHeure() ? -1 : 1;
                }
                return $object1->getDate() <= $object2->getDate() ? -1 : 1;
            });
            $functions = $this->get('session')->get('functions');

            return $this->render('transaction/index.html.twig', array(
                'transactions' => $transactions,
                'functions' => $functions,
                'clt' => $clt,
                'profil' => $user
            ));
        } else {
            return $this->redirectToRoute('utilisateur_cnx');
        }
    }

    public function trsAddAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $carte1 = $em->getRepository('GestionCarteBundle:Carte')->find("123456789");
        $carte2 = $em->getRepository('GestionCarteBundle:Carte')->find("123456781");
        $carte3 = $em->getRepository('GestionCarteBundle:Carte')->find("123456780");
        $type4 = $em->getRepository('GestionTransactionBundle:Type_Transaction')->find(2);
        $tpe = $em->getRepository('GestionTransactionBundle:TPE')->find(4);
        $terminl = $em->getRepository('GestionTransactionBundle:Terminal')->find(2);
        $station = $em->getRepository('GestionCarteBundle:Station')->find(2);
        $mntL=0;
        $prod="";
        for ($i = 0; $i < 500; $i++) {
            $TrFrom = new Transaction();

            if ($i == 0)
                $lastTr = 0;
            else
                $lastTr = $em->getRepository("GestionTransactionBundle:Transaction")->findOneBy(
                    array(),
                    array('id_transaction' => 'DESC')
                )->getIdTransaction();

            if (($i % 2) == 0) {
                $carte = $carte2;
                $prod="Gasoil";
                $mntL=1.140;

            } else if (($i % 3) == 0) {
                $carte = $carte3;
                $prod="Gasoil 50";
                $mntL=1.420;
            } else {
                $carte = $carte1;
                $prod="Sans Plomb";
                $mntL=1.650;
            }

            if ($carte->getClient() != null) {
                $clt = $carte->getClient();
                $clt->getAdress();
            } else {
                $clt = $em->getRepository('GestionCarteBundle:Client')->find(-1);
            }
            $int = mt_rand(1483225200, 1496095200);
           // $date = date("Y-m-d H:i:s", $int);
            $h = date("H:i:s", $int);
            $d = date("Y-m-d", $int);

            $TrFrom->setProduit($prod);
            $TrFrom->setIdTransaction(intval($lastTr) + 1);
            $TrFrom->setCarte($carte);
            $TrFrom->setNumTicket("12345678912".$i);
            $TrFrom->setType($type4);

            $montant = mt_rand(1, 5);
            $montant*=10;
            $TrFrom->setMontant($montant);
            $TrFrom->setVolume(strval ($montant/$mntL));
            $TrFrom->setSolde($carte->solde - $montant);
            $TrFrom->setHeure(new \DateTime($h));
            $TrFrom->setDate(new \DateTime($d));
            $TrFrom->setTpe($tpe);
            $TrFrom->setTerminal($terminl);
            $TrFrom->setStation($station);
            $TrFrom->setClient($clt);


            $em->persist($TrFrom);
            $em->flush();
            $carte->setSolde($carte->solde-$montant);
            $em->flush();


        }


    }

    public function historiqueAction(Request $request)
    {
        if ($this->get('session')->get('user') != null) {
            $from = $request->request->all();
            $em = $this->getDoctrine()->getManager();
            $user = $this->get('session')->get('user');
            $transactions = $em->getRepository('GestionTransactionBundle:Transaction')->findBydaterange($from['start'], $from['end'], $user->getCarte()->getNumCarte());
            /* usort($transactions, function(\GestionTransactionBundle\Entity\Transaction $object1, \GestionTransactionBundle\Entity\Transaction$object2)
             {

                 if($object1->getDate()==$object2->getDate())
                 {
                     return  $object1->getHeure() <= $object2->getHeure() ? -1 : 1;
                 }
                 return  $object1->getDate()<= $object2->getDate() ? -1 : 1;
             });*/

            $clt = null;
            if ($user->getType() == 0) {
                $clt = $em->getRepository('GestionCarteBundle:Client')->find($user->getCompteClt()->getIdClient());
                $d = $clt->getDesignation();
            }

            $daterange = "Du: " . $from['start'] . " Jusqu'a: " . $from['end'];
            $functions = $this->get('session')->get('functions');
            return $this->render('transaction/index.html.twig', array(
                'transactions' => $transactions,
                'daterange' => $daterange,
                'functions' => $functions,
                'clt' => $clt,
                'profil' => $user
            ));
        } else {
            return $this->redirectToRoute('utilisateur_cnx');
        }
    }

    public function historiqueGerantAction(Request $request)
    {


        $em = $this->getDoctrine()->getManager();
        $user = $this->get('session')->get('user');
        $start = $request->get('start');
        $end = $request->get('end');
        $station = $request->get('id_station');
        $transactions = $em->getRepository('GestionTransactionBundle:Transaction')->findGerantBydaterange($start, $end, $station);
        usort($transactions, function (\GestionTransactionBundle\Entity\Transaction $object1, \GestionTransactionBundle\Entity\Transaction $object2) {

            if ($object1->getDate() == $object2->getDate()) {
                return $object1->getHeure() <= $object2->getHeure() ? -1 : 1;
            }
            return $object1->getDate() <= $object2->getDate() ? -1 : 1;
        });
        $json = new JsonResponse(json_encode($transactions));
        return $json;

    }


    /**
     * @param Request $request
     * @return Response
     */
    public function trPerDayAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('session')->get('user');
        $day = $request->get('day');
        $station = $request->get('id_station');
        $transactions = $em->getRepository('GestionTransactionBundle:Transaction')->findByday($day, $station);

        $json = new JsonResponse(json_encode($transactions));
        return $json;


    }


    public function trGerantAction(Request $request)
    {
        if ($this->get('session')->get('user') != null) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->get('session')->get('user');
            $station = $request->request->get('id');

            //$daysStat=array();
            //foreach ($stations as $station) {
            $daysStat = $em->getRepository('GestionTransactionBundle:Transaction')->findAllTrForGerant($station);
            // $daysStat=array_merge($daysStat,  $transactions);
            // }
            $functions = $this->get('session')->get('functions');
            return $this->render('transaction/transactionGerant.html.twig', array(
                'daysStat' => $daysStat,
                'idstation' => $station,
                'functions' => $functions,
                'gerant' => $user
            ));
        } else {
            return $this->redirectToRoute('utilisateur_cnx');
        }
    }


}
