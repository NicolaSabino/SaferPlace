<?php

class Livello3Controller extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->layout->setLayout('layout3');
    }

    public function indexAction()
    {
        $edificiModel = new Application_Model_Edifici();
        $this->view->arrayEdifici = $edificiModel->getEdificiSet();
        
        $utenzaModel = new Application_Model_Utenza();
        $this->view->arrayUtenti = $utenzaModel->getUtenza();


    }


}

