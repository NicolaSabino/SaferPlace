<?php

class Livello2Controller extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->layout->setLayout('layout1');
    }

    public function indexAction()
    {
        // action body
    }

    public function notifyAction()
    {

        $utente= new Application_Model_UtenteStaff();
        $notifiche = new Application_Resource_Notifica();

        //estraggo i risultati dell'esecuzione della query e li stampo
        $this->view->assign("notifiche", $utente->getNotificheEmergenze());


        //$this->view->assign('notifiche',$notifiche->fetchAll());

    }

    public function dashboardAction()
    {
        $modelUtente = new Application_Model_UtenteStaff();
      /*  print_r($modelUtente->getNotificheEmergenze());
die;*/
        $this->view->assign("edifici_e_piani",$modelUtente->getEdificiGestiti('nicolanabbo'));
        $this->view->assign("notifiche", $modelUtente->getNotificheEmergenze());




    }

    


}





