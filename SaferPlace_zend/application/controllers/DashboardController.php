<?php

class DashboardController extends Zend_Controller_Action
{


    public function init()
    {

    }

    public function indexAction()
    {


        $this->popolaEdifici();


        //TODO: istanzio l'insieme delle NOTIFICHE estraendole dal model
        //$notificheModel = new Application_Model_Faq();// hai messo faq ma qui ci vogliono sengalazioni ovvero notifiche


    }

    protected function popolaEdifici(){

        $edificiModel = new Application_Model_Edifici();
        $pianiModel = new Application_Model_Piani();

        //inizializzo il set che conterrà linsieme degli edifici e i relativi piani
        $setEdifici = array();

        foreach($edificiModel as $item){

            $nomeEdifico = $item->nome;
            $piani = $pianiModel->getPianiByEdificio($nomeEdifico);
            $app = array($nomeEdifico => $piani);
            array_push($setEdifici, $app );
        }

        $this->view->assign("edifici", $setEdifici);
        $this->view->assign("nomiEdifici", $edificiModel->getEdifici());
    }


}

