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
        $notifiche = new Application_Resource_Notifica();

        //estraggo i risultati dell'esecuzione della query e li stampo
        $this->view->assign("notifiche", $utente->getNotificheEmergenze());


        //$this->view->assign('notifiche',$notifiche->fetchAll());

    }

    public function dashboardAction()
    {
        $modelUtente = new Application_Model_UtenteStaff();

        if (($edificio = $this->controllaParam('edificio')) && ($piano = $this->controllaParam('piano')))
            $this->view->assign("pianta", $edificio . ' Piano ' . $piano . '.jpg');

        $this->view->assign("edifici_e_piani",$modelUtente->getEdificiGestiti('nicolanabbo'));

        if ($notifiche = $modelUtente->getNotificheEmergenze())
            $this->view->assign("notifiche", $notifiche);

        if ($evacuazioni = $modelUtente->fetchEventi())
            $this->view->assign("evacuazioni", $evacuazioni);


    }

    public function controllaParam($param)
    {
        $parametro=0;
        if($this->hasParam("$param"))
            $parametro=$this->getParam("$param");
        return $parametro;
    }

    public function delnotifAction()
    {
        $modelUtente= new Application_Model_UtenteStaff();

        if (($edificio = $this->controllaParam('edificio')) && ($piano = $this->controllaParam('piano')))
            $this->view->assign("pianta", $edificio . ' Piano ' . $piano . '.jpg');
        $modelUtente->deleteNotification($this->controllaParam('id'));
        $this->getHelper('Redirector')->gotoRoute(array('controller'=>'livello2', 'action'=>'dashboard',
                                                    'edificio'=> $edificio, 'piano'=>$piano));
    }


}







