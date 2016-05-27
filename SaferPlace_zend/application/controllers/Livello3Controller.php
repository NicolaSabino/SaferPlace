<?php

class Livello3Controller extends Zend_Controller_Action
{

    protected $_edificiModel = null;

    protected $_utenzaModel = null;

    protected $_faqModel = null;

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
        $this->view->id = $id;

        
        //istanzio la form per modificare la faq
        $this->_faqForm = new Application_Form_ModificaFaq($domanda,$risposta,$id);

        //imposto la action della form
        $this->_faqForm->setAction($this->view->url(
            array(
                'controller'    => 'livello3',
                'action'        => 'updatefaq',
            ),null,true
        ));

        //assegno la form alla view
        $this->view->faqForm=$this->_faqForm;

    }

    public function updatefaqAction()
    {

        $dom=$this->getParam('domanda');
        $risp=$this->getParam('risposta');
        $idFaq=$this->getParam("id");
        

        $this->_faqModel = new Application_Model_Faq();
        $this->_faqModel->setFaq($dom,$risp,$idFaq);

        //reindirizzo a gestione faq
        $this->getHelper('Redirector')->gotoSimple('gestionefaq','livello3',$module=null);
    }

    public function creafaqAction()
    {
        //istanzio la form per modificare la faq
        $faqForm = new Application_Form_ModificaFaq();

        //imposto la action della form
        $faqForm->setAction($this->view->url(
            array(
                'controller'    => 'livello3',
                'action'        => 'insertfaq',
            ),null,true
        ));

        //assegno la form alla view
        $this->view->faqForm=$faqForm;
    }

    /**
     *  Inserisco una nuova faq nel db
     *
     */
    public function insertfaqAction()
    {

        $dom=$this->getParam('domanda');
        $risp=$this->getParam('risposta');

        $this->_faqModel = new Application_Model_Faq();
        $this->_faqModel->newFaq($dom,$risp);

        //reindirizzo a gestione faq
        $this->getHelper('Redirector')->gotoSimple('gestionefaq','livello3',$module=null);
        
    }

    public function eliminafaqAction()
    {

        $id=$this->getParam('id');

        $this->_faqModel = new Application_Model_Faq();
        $this->_faqModel->deleteFaq($id);

        //reindirizzo a gestione faq
        $this->getHelper('Redirector')->gotoSimple('gestionefaq','livello3',$module=null);
    }

    public function creautenteAction()
    {
        //istanzio la form di registrazione di un nuovo utente
        $registrazioneform = new Application_Form_Registratiform();


        //imposto la action della form
        $registrazioneform->setAction($this->view->url(
            array(
                'controller'    => 'livello3',
                'action'        => '',
            ),null,true
        ));

        //assegno la form alla view
        $this->view->registrazioneform = $registrazioneform;
        
    }


}



















