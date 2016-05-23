<?php

class Livello2Controller extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->layout->setLayout('layout3');
    }

    public function indexAction()
    {
        // action body
    }

    public function notifyAction()
    {

        $utente= new Application_Model_UtenteStaff();
        $notifiche = $utente->getNotificheEmergenze();
        //estraggo i risultati dell'esecuzione della query e li stampo
        $this->view->assign("notifiche", $utente->getNotificheEmergenze());


        //$this->view->assign('notifiche',$notifiche->fetchAll());

    }[]

    public function dashboardAction()
    {
        $modelUtente             = new Application_Model_UtenteStaff();
     

        $this->view->assign("edifici_e_piani",$modelUtente->getEdificiGestiti('nicolanabbo'));


        /*
         *  genero le notifiche
         */



        //genero un array di edifici gestiti

       // $gestiti = array();

        //$array=$edifici->getEdificiGestiti('nicolanabbo');

       /* foreach ($array as $x=>$y){
           foreach ($y as )
            array_push($gestiti,$y);
        }
*/
        //print_r($array);



    }


}





