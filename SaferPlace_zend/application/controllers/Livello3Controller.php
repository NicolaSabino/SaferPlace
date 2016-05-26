<?php

class Livello3Controller extends Zend_Controller_Action
{

    protected $_edificiModel;

    protected $_utenzaModel;

    protected $_faqModel;

    public function init()
    {
        $this->_helper->layout->setLayout('layout3');


        $this->_edificiModel = new Application_Model_Edifici();
        $this->view->arrayEdifici = $this->_edificiModel->getEdificiSet();

        $utenzaModell = new Application_Model_Utenza();
        $this->view->arrayUtenti = $utenzaModell->getUtenza();


        $this->_faqModel = new Application_Model_Faq();
        $this->view->assign("faqSet",$this->_faqModel->getFaqSet());
    }

    public function indexAction()
    {
        // action body
    }

    public function gestioneedificiAction()
    {
        // action body
    }

    public function gestionepianifugaAction()
    {
        // action body
    }

    public function gestionefaqAction()
    {
        // action body
    }

    public function gestioneutentiAction()
    {
        // action body
    }


}













