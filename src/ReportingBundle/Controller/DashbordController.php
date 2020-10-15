<?php

namespace ReportingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class DashbordController extends Controller
{
    public function DashbordPAction()
    {
        if ($this->get('session')->get('user') != null) {
            $functions = $this->get('session')->get('functions');
            $test = $functions[0]->getNomFN();
            $user = $this->get('session')->get('user');


            return $this->render('Dashbords/DashboardP.html.twig', array(
                'functions' => $functions,
                'profil' => $user

            ));
        } else {
            return $this->redirectToRoute('utilisateur_cnx');
        }

    }

    public function LitreCltAction(Request $request)
    {
        $l = 0;
        $user = $this->get('session')->get('user');

        $trs = $this->getDoctrine()->getManager()->getRepository('GestionTransactionBundle:Transaction')->findBy(array("client" => $user->getCompteClt()->getIdClient()));

        $mois = $request->get('mois');
        $prod = $request->get('prod');
        foreach ($trs as $tr) {
            if ($tr->getDate()->format('m') == $mois) {

                if($prod=="Tous")
                {
                    if($tr->getVolume()!=null)
                    {$l+=floatval($tr->getVolume());}
                }
                else
                {
                    if($tr->getProduit()==$prod)
                    {
                        if($tr->getVolume()!=null)
                        {$l+=floatval($tr->getVolume());}
                    }

                }





            }


        }
        $rep=array("litres"=>$l);
        return new JsonResponse($rep);
    }

    public function DashbordCAction()
    {
        if ($this->get('session')->get('user') != null) {
            $functions = $this->get('session')->get('functions');
            $user = $this->get('session')->get('user');

            $clt = null;
            if ($user->getType() == 0) {
                $clt = $this->getDoctrine()->getManager()->getRepository('GestionCarteBundle:Client')->find($user->getCompteClt()->getIdClient());
                $d = $clt->getDesignation();
            }


            return $this->render('Dashbords/DashboardC.html.twig', array(
                'functions' => $functions,
                'clt' => $clt
            ));
        } else {
            return $this->redirectToRoute('utilisateur_cnx');
        }
    }

    public function CATodayAction(Request $request)
    {
        $user = $this->get('session')->get('user');

        $stations = $this->getDoctrine()->getManager()->getRepository('GestionCarteBundle:Station')->findBy(array('gerant'=>$user->getCompteGerant()->getIdGerant()));
      $AllTrs=array();
      //$today=date("Y-m-d",date_timestamp_get(new \DateTime('now'))); //time dynamic
        $today="2017-05-04";
        foreach ($stations as $stat)
        {
           $trs=$this->getDoctrine()->getManager()->getRepository('GestionTransactionBundle:Transaction')->findBy(array('station'=>$stat->getIdStation(),'date'=>new \DateTime($today)));
            $AllTrs = array_merge($AllTrs, $trs);

        }

        usort($AllTrs, function (\GestionTransactionBundle\Entity\Transaction $object1, \GestionTransactionBundle\Entity\Transaction $object2) {


            return $object1->getStation()->getAdress() <= $object2->getStation()->getAdress() ? -1 : 1;
        });

        $CA=0;
        $CAS=0;
        $CAStations=array();

        $s=$AllTrs[0]->getStation()->getAdress();
        if(count($AllTrs)!=0)
        {

            foreach ($AllTrs as $tr)
            {
                if(($tr->getType()->getAbreviation()=="recharge")or($tr->getType()->getAbreviation()=="ach"))
                {
                    $CA+=$tr->getMontant();
                    $CAS+=$tr->getMontant();
                }
                elseif ($tr->getType()->getAbreviation()=="annul")
                {
                    $CA-=$tr->getMontant();
                    $CAS-=$tr->getMontant();
                }
                if($tr->getStation()->getAdress()!=$s)
                {
                    $CAStations[$s]=$CAS-$tr->getMontant();
                    $CAS=$tr->getMontant();
                    $s=$tr->getStation()->getAdress();
                }
            }


            if(count($AllTrs)==1)
            {
                $CAStations[$s]=$CA;
            }
            else
            {
                $CALastSatation=array_sum($CAStations);
                $CAStations[$s]=$CA-$CALastSatation;
            }
            $CAStations["all"]=$CA;
        }


        return new JsonResponse(json_encode($CAStations));



    }


    public function TopCltAction(Request $request)
    {
        $user = $this->get('session')->get('user');
        $mois = $request->get('mois');
        //$mois=5;
        if($mois<10)
        {
            $mois="0".$mois;
        }
        $cv=strtotime("2017-".$mois."-31");


            $datefin="2017-".$mois."-".date('t',strtotime("2017-".$mois."-01"));


        $stations = $this->getDoctrine()->getManager()->getRepository('GestionCarteBundle:Station')->findBy(array('gerant'=>$user->getCompteGerant()->getIdGerant()));
        $AllTrs=array();

        foreach ($stations as $stat)
        {
            $trs=$this->getDoctrine()->getManager()->getRepository('GestionTransactionBundle:Transaction')->TopCltTrs("2017-".$mois."-01",$datefin,$stat->getIdStation());
            $AllTrs = array_merge($AllTrs, $trs);

        }

        usort($AllTrs, function (\GestionTransactionBundle\Entity\Transaction $object1, \GestionTransactionBundle\Entity\Transaction $object2) {


            return $object1->getClient()->getDesignation() <= $object2->getClient()->getDesignation() ? -1 : 1;
        });

        $CA=0;
        $CAC=0;
        $CA_Clt=array();



        if(count($AllTrs)!=0)
        {
            $s=$AllTrs[0]->getClient()->getDesignation();

            foreach ($AllTrs as $tr)
            {
                if(($tr->getType()->getAbreviation()=="recharge")or($tr->getType()->getAbreviation()=="ach"))
                {
                    $CA+=$tr->getMontant();
                    $CAC+=$tr->getMontant();
                }
                elseif ($tr->getType()->getAbreviation()=="annul")
                {
                    $CA-=$tr->getMontant();
                    $CAC-=$tr->getMontant();
                }
                if($tr->getClient()->getDesignation()!=$s)
                {
                    $CA_Clt[$s]=$CAC-$tr->getMontant();
                    $CAC=$tr->getMontant();
                    $s=$tr->getClient()->getDesignation();
                }
            }


            if(count($AllTrs)==1)
            {
                $CA_Clt[$s]=$CA;
            }
            else
            {
                $CALastClt=array_sum($CA_Clt);
                $CA_Clt[$s]=$CA-$CALastClt;
            }
            $CA_Clt["all"]=$CA;
        }

        arsort($CA_Clt);
        $TopClt=array_slice($CA_Clt,0,6);
        $TopClt["Autres"]=array_sum(array_slice($CA_Clt,6,count($CA_Clt)-1));


        return new JsonResponse(json_encode($TopClt));



    }

    public function CAYearPerMonth_ProduitAction(Request $request)
    {
        $user = $this->get('session')->get('user');

        //$mois=5;




        $AllTrs=array();
        if($user->getType()==0)
        {
            $AllTrs=$this->getDoctrine()->getManager()->getRepository('GestionTransactionBundle:Transaction')->LitresPerYear("2017-01-01","2017-12-31",$user->getCompteClt()->getIdClient());
        }
        else
        {
            $stations = $this->getDoctrine()->getManager()->getRepository('GestionCarteBundle:Station')->findBy(array('gerant'=>$user->getCompteGerant()->getIdGerant()));
            foreach ($stations as $stat)
            {
                $trs=$this->getDoctrine()->getManager()->getRepository('GestionTransactionBundle:Transaction')->TopCltTrs("2017-01-01","2017-12-31",$stat->getIdStation());
                $AllTrs = array_merge($AllTrs, $trs);

            }
        }



         usort($AllTrs, function(\GestionTransactionBundle\Entity\Transaction $object1, \GestionTransactionBundle\Entity\Transaction$object2)
             {

                 if($object1->getDate()==$object2->getDate())
                 {
                     return  $object1->getHeure() <= $object2->getHeure() ? -1 : 1;
                 }
                 return  $object1->getDate()<= $object2->getDate() ? -1 : 1;
             });

        $CA=0;

        $CA_essence=array("01"=>0,"02"=>0,"03"=>0,"04"=>0,"05"=>0,"06"=>0,"07"=>0,"08"=>0,"09"=>0,"10"=>0,"11"=>0,"12"=>0);
        $CA_gasoil=array("01"=>0,"02"=>0,"03"=>0,"04"=>0,"05"=>0,"06"=>0,"07"=>0,"08"=>0,"09"=>0,"10"=>0,"11"=>0,"12"=>0);
        $CA_gasoil50=array("01"=>0,"02"=>0,"03"=>0,"04"=>0,"05"=>0,"06"=>0,"07"=>0,"08"=>0,"09"=>0,"10"=>0,"11"=>0,"12"=>0);

        $essence=0;
        $gasoil=0;
        $gasoil50=0;


        $CA_tot=array();
        if(count($AllTrs)!=0)
        {
            $s=date('m',$AllTrs[0]->getDate()->getTimestamp());
            foreach ($AllTrs as $tr)
            {
                if(date('m',$tr->getDate()->getTimestamp())!=$s)
                {
                    $CA_essence[$s]=$essence;
                    $CA_gasoil[$s]=$gasoil;
                    $CA_gasoil50[$s]=$gasoil50;
                    $essence=0;
                    $gasoil=0;
                    $gasoil50=0;
                    $s=date('m',$tr->getDate()->getTimestamp());
                }
                else
                {
                    if(($tr->getType()->getAbreviation()=="recharge")or($tr->getType()->getAbreviation()=="ach"))
                    {
                        $CA+=$tr->getMontant();
                        if($tr->getProduit()=="Gasoil")
                        {
                            $gasoil+=$tr->getMontant();
                        }
                        elseif ($tr->getProduit()=="Gasoil 50")
                        {
                            $gasoil50+=$tr->getMontant();
                        }
                        else
                        {
                            $essence+=$tr->getMontant();

                        }

                    }
                    elseif ($tr->getType()->getAbreviation()=="annul")
                    {
                        $CA-=$tr->getMontant();
                        if($tr->getProduit()=="Gasoil")
                        {
                            $gasoil-=$tr->getMontant();
                        }
                        elseif ($tr->getProduit()=="Gasoil 50")
                        {
                            $gasoil50-=$tr->getMontant();
                        }
                        else
                        {
                            $essence-=$tr->getMontant();

                        }
                    }
                }


            }
//e5er wa7da mt7atetch 5ater ch'har mtbadalch
            $CA_essence[$s]=$essence;
            $CA_gasoil[$s]=$gasoil;
            $CA_gasoil50[$s]=$gasoil50;

            $CA_tot["all"]=$CA;
            $CA_tot["essence"]=$CA_essence;
            $CA_tot["gasoil"]=$CA_gasoil;
            $CA_tot["gasoil50"]=$CA_gasoil50;
        }
        return new JsonResponse(json_encode($CA_tot));



    }

    public function DepenceYearPerMonth_Client_ProteurtAction(Request $request)
    {
        $user = $this->get('session')->get('user');

        //$mois=5;




        $AllTrs=array();
        if($user->getType()==2)
        {
            $AllTrs=$this->getDoctrine()->getManager()->getRepository('GestionTransactionBundle:Transaction')->AllMonthProteur_Client("2017-01-01","2017-12-31",$user->getCarte());
        }
        else
        {
            $Cartes=$this->getDoctrine()->getManager()->getRepository('GestionCarteBundle:Carte')->findBy(array('client'=>$user->getCompteClt()->getIdClient()));
            foreach ($Cartes as $carte)
            {
                $trs=$this->getDoctrine()->getManager()->getRepository('GestionTransactionBundle:Transaction')->AllMonthProteur_Client("2017-01-01","2017-12-31",$carte->getNumCarte());
                $AllTrs = array_merge($AllTrs, $trs);

            }
        }



       /* usort($AllTrs, function(\GestionTransactionBundle\Entity\Transaction $object1, \GestionTransactionBundle\Entity\Transaction$object2)
        {

            return  $object1->getDate()<= $object2->getDate() ? -1 : 1;
        });*/



        $YearDepence=array();
        for ($i=1;$i<=12;$i++)
        {
            $Monthdays=array();
            $lastdayMonth=date('t',strtotime("2017-".$i."-01"));
            for ($j=1;$j<=$lastdayMonth;$j++)
            {
                $Monthdays[$j]=0;
            }
            $YearDepence[$i]=$Monthdays;
        }

        $depencePerDay=0;





        if(count($AllTrs)!=0)
        {
            $s=date('n',$AllTrs[0]->getDate()->getTimestamp());
            $d=date('j',$AllTrs[0]->getDate()->getTimestamp());
            for ($i=0;$i<count($AllTrs);$i++)
            {

                if(date('n',$AllTrs[$i]->getDate()->getTimestamp())!=$s)
                {
                    $YearDepence[$s][$d]=$depencePerDay;

                    $depencePerDay=$AllTrs[$i]->getMontant();
                    $s=date('n',$AllTrs[$i]->getDate()->getTimestamp());
                  /*  if(date('j',$AllTrs[$i++]->getDate()->getTimestamp())!=date('j',$AllTrs[$i]->getDate()->getTimestamp()))
                    {$YearDepence[$s][1]=$depencePerDay;}*/
                    $d=date('j',$AllTrs[$i]->getDate()->getTimestamp());
                }
                elseif (date('j',$AllTrs[$i]->getDate()->getTimestamp())!=$d)
                {
                    $x=date('j',$AllTrs[$i]->getDate()->getTimestamp());
                    $YearDepence[$s][$d]=$depencePerDay;
                    $depencePerDay=$AllTrs[$i]->getMontant();
                    $d=date('j',$AllTrs[$i]->getDate()->getTimestamp());
                }
                else
                {
                    $x=date('j',$AllTrs[$i]->getDate()->getTimestamp());
                    if(($AllTrs[$i]->getType()->getAbreviation()=="recharge")or($AllTrs[$i]->getType()->getAbreviation()=="ach"))
                    {
                        $depencePerDay+=$AllTrs[$i]->getMontant();
                          $m=$i;
                           $tet=1;


                    }
                    elseif ($AllTrs[$i]->getType()->getAbreviation()=="annul")
                    {
                        $depencePerDay-=$AllTrs[$i]->getMontant();

                    }
                }


            }
//e5er wa7da mt7atetch 5ater ch'har mtbadalch
            $YearDepence[$s][$d]=$depencePerDay;



        }
        return new JsonResponse(json_encode($YearDepence));



    }

    public function DashbordGAction()
    {


        $functions = $this->get('session')->get('functions');
        $user = $this->get('session')->get('user');

        return $this->render('Dashbords/DashbordG.html.twig', array(
            "functions" => $functions,
            'gerant' => $user,

        ));
    }


}

