<?php

class Livello3Controller extends Zend_Controller_Action
{

    protected $_edificiModel = null;

    protected $_utenzaModel = null;

    protected $_faqModel = null;

    protected $_faqForm = null;

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

    public function modificafaqAction()
    {

        $domanda=$this->getParam("domanda");
        $risposta=$this->getParam("risposta");
        $id=$this->getParam("id");
        
        //istanzio la form per modificare la faq
        $this->_faqForm = new Application_Form_ModificaFaq($domanda,$risposta,$id);

        //imposto la action della form TODO
        $this->_faqForm->setAction($this->view->url(
            array(
                'controller' => 'livello1',
                'action' => 'index',
            )
        ));

        //assegno la form alla view
        $this->view->faqForm=$this->_faqForm;

    }

    
}















