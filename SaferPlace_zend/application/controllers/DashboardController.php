<?php

class DashboardController extends Zend_Controller_Action
{

    public function init()
    {
        
    }

    public function indexAction()
    {
        //istanzio l'insieme degli edifici estraendole dal model
        $edificiModel = new Application_Model_Edifici();
        
        //TODO: istanzio l'insieme delle NOTIFICHE estraendole dal model
        $notificheModel = new Application_Model_Faq();

        //assegno alla view le variabili
        $this->view->assign("edifici",$edificiModel->getEdifici());
        //$this->view->assign("notifiche",$notificheModel->getFaqSet());
    }


}

