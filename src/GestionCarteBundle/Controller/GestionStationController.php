<?php

namespace GestionCarteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class GestionStationController extends Controller
{
    public function indexAction()
    {
        $user=$this->get('session')->get('user');
        if($user!=null)
        {
            $em = $this->getDoctrine()->getManager();

            $carte_principal=null;
            if($user->getType()==1)
            {
                //$date=new \DateTime('now');
                //$today=$date->format('Y-m-d');
                $stations = $em->getRepository('GestionCarteBundle:Station')->findBy(array('gerant' => $user->getCompteGerant()));
               // $todayStat = $em->getRepository('GestionTransactionBundle:Transaction')->findAllTrForGerantPerDay($stations[1], $today);
                $functions=$this->get('session')->get('functions');
                return $this->render('Station/index.html.twig',array(
                    'stations'=>$stations,
                    'nbr_station'=>count($stations),
                    'station_principal'=>$stations[0],
                    'gerant'=>$user,
                    'functions' => $functions
                    //'todayStat'=> $todayStat
                ));


            }



        }
        else
        {
            return $this->redirectToRoute('utilisateur_cnx');
        }
    }

    public function ToDayStatAction(Request $request)
    {
        $user=$this->get('session')->get('user');
        $em = $this->getDoctrine()->getManager();
        $id_station=$request->get('id_station');
        $stations = $em->getRepository('GestionCarteBundle:Station')->findBy(array('gerant' => $user->getCompteGerant()));
        $date=new \DateTime('now');
        $today=$date->format('Y-m-d');
        $todayStat = $em->getRepository('GestionTransactionBundle:Transaction')->findAllTrForGerantPerDay($id_station, $today);
        $json=new JsonResponse(json_encode($todayStat));
        return $json;

    }

    public function TrshiftAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $id_station=$request->get('id_station');
        $transactions=$em->getRepository('GestionTransactionBundle:Transaction')->findShiftTrStation($id_station);
        $json=new JsonResponse(json_encode($transactions));
        return $json;

    }
}
