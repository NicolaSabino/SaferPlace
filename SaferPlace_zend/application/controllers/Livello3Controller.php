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
                'action'        => 'nuovoutente',
            ),null,true
        ));

        //assegno la form alla view
        $this->view->registrazioneform = $registrazioneform;
        
    }

    public function nuovoutenteAction()
    {


        $elementi = array(
            'nome'      =>  $this->getParam('Nome'),
            'cognome'   =>  $this->getParam('Cognome'),
            'genere'    =>  $this->getParam('genere'),
            'eta'       =>  $this->getParam('eta'),
            'telefono'  =>  $this->getParam('telefono'),
            'username'  =>  $this->getParam('username'),
            'password'  =>  $this->getParam('password'),
            'email'     =>  $this->getParam('email'),
            'livello'   =>  $this->getParam('livello'),
        );

        

        //avvio la procedura di inserimento nel db tramite una chiamata ad un oggetto del model
        $utenza = new Application_Model_Utenza();
        
        $utenza->nuovoUtente($elementi);
        
        
        

        //reindirizzo a gestione faq
        $this->getHelper('Redirector')->gotoSimple('gestioneutenti','livello3',$module=null);
    }

    public function modificautenteAction()
    {
        $elementi = array(
            'nome'      =>  $this->getParam('nome'),
            'cognome'   =>  $this->getParam('cognome'),
            'genere'    =>  $this->getParam('genere'),
            'eta'       =>  $this->getParam('eta'),
            'telefono'  =>  $this->getParam('telefono'),
            'username'  =>  $this->getParam('username'),
            'password'  =>  $this->getParam('password'),
            'email'     =>  $this->getParam('email'),
            'livello'   =>  $this->getParam('livello')
        );
        


        //istanzio la form di registrazione di un nuovo utente
        $form = new Application_Form_Gestisciutente($elementi);


        //imposto la action della form
        $form->setAction($this->view->url(
            array(
                'controller'    => 'livello3',
                'action'        => 'updateutente',
                'old'       =>  $elementi['username'],

            ),null,true
        ));

        //assegno la form alla view
        $this->view->form = $form;

    }

    public function updateutenteAction(){

        $elementi = array(
            
            'old'   =>  $this->getParam('old'),
            'nome'      =>  $this->getParam('Nome'), //errore
            'cognome'   =>  $this->getParam('Cognome'), //errore
            'genere'    =>  $this->getParam('genere'),
            'eta'       =>  $this->getParam('eta'),
            'telefono'  =>  $this->getParam('telefono'),
            'username'  =>  $this->getParam('username'),
            'password'  =>  $this->getParam('password'),
            'email'     =>  $this->getParam('email'),
            'livello'   =>  $this->getParam('livello')
        );
        

        $utenza = new Application_Model_Utenza();
        $utenza->modificaUtente($elementi);

        //reindirizzo a gestione faq
        $this->getHelper('Redirector')->gotoSimple('gestioneutenti','livello3',$module=null);
    }


}





















