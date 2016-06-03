<?php

class Livello3Controller extends Zend_Controller_Action
{

    protected $_edificiModel = null;
    protected $_utenzaModel = null;
    protected $_faqModel = null;
    protected $_modificaEdificioForm = null;
    protected $user;
    protected $_authService;

    public function init()
    {
        $this->_helper->layout->setLayout('layout3');
        $this->_authService = new Application_Service_Auth();
        $this->user=$this->_authService->getAuth()->getIdentity()->current()->username;

        $this->_modificaEdificioForm = new Application_Form_Gestioneedificio();

        $this->_edificiModel = new Application_Model_Edifici();
        $this->view->arrayEdifici = $this->_edificiModel->getEdificiSet();

        $utenzaModell = new Application_Model_Utenza();
        $this->view->arrayUtenti = $utenzaModell->getUtenza();

        $this->_faqModel = new Application_Model_Faq();
        $this->view->assign("faqSet",$this->_faqModel->getFaqSet());


        //istanzio la form di modifica di un edificio
        $this->_modificaEdificioForm = new Application_Form_Gestioneedificio();
    }




    /********************************************/



    // MENU

    public function indexAction()
    {

    }

    public function gestioneedificiAction()
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

    /**
     *  Popola la schermata che permette all'admin di gestire le assegnazioni dello staff
     */
    public function scegliedificioAction()
    {

        $username=$this->getParam('username');

        $edifici = new Application_Model_Edifici();
        $edificiNonAssegnati=$edifici->nonAssegnati();

        $edificiAssegnati = $edifici->getGestioni();

        $this->view->assign('edificiNonAssegnati',$edificiNonAssegnati);
        $this->view->assign('edificiAssegnati',$edificiAssegnati);
        $this->view->assign('username',$username);

    }

    /**
     * Popolo la schermata che permette di gestire un edificio
     */
    public function modificaedificioAction()
    {
        $app = $this->getParam('edificio');
        $modelEdifici = new Application_Model_Edifici();
        $modelPiani = new Application_Model_Piani();
        $edificio = $modelEdifici->getEdificio($app);
        $piani = $modelPiani->getPianiByEdificio($app);

        $this->view->assign('edificio',$edificio);
        $this->view->assign('piani',$piani);

    }




    /**************************************************/



    // FORM

    /**
     * Predispone la form per modificare una faq
     */
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

    /**
     * Predispongo la form per inserire una nuova faq
     */
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
     * Predispone la form per inserire un nuovo utente
     */
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

    /**
     * Procedura che predispone la form di aggiornamento delle informazioni di un utente
     */
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
        $form->populate($elementi);


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

    /**
     *  Creo la view con relativa form che permette di modificare NOME INFORMAZIONI E IMMAGINE di un edificio
     */
    public function modificadescrizioneAction()
    {
        //prendo le informazioni per popolare la form
        $nomeEdificio = $this->getParam('edificio');
        $edificiModel = new Application_Model_Edifici();
        $edificio = $edificiModel->getEdificio($nomeEdificio);


        //valori per popolare la form
        $data = array(
            'nome'          => $nomeEdificio,
            'mappa'         => $edificio->current()->mappa,
            'informazioni'  => $edificio->current()->informazioni
        );

        //istanzio la form
        $this->_modificaEdificioForm->populate($data); // todo finire

        $this->_modificaEdificioForm->setAction($this->view->url(
            array(
                'controller'    => 'livello3',
                'action'        => 'submitmodificadescrizione',
                'oldname'       => $nomeEdificio
            )
        ));

        //assegno la form alla view

        $this->view->assign('Form',$this->_modificaEdificioForm);
        return $this->_modificaEdificioForm;
    }





    /**************************************************/

    //  INTERFACCIAMENTO CON IL MODEL

    /**
     * aggiorno una faq nel db
     */
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

    /**
     * Metodo che inserisce una faq nel db
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

    /**
     * metodo che elimina una faq dal db
     */
    public function eliminafaqAction()
    {

        $id=$this->getParam('id');

        $this->_faqModel = new Application_Model_Faq();
        $this->_faqModel->deleteFaq($id);

        //reindirizzo a gestione faq
        $this->getHelper('Redirector')->gotoSimple('gestionefaq','livello3',$module=null);
    }

    /**
     * Metodo che permette di inserire un utente nel db
     */
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
        );



        //avvio la procedura di inserimento nel db tramite una chiamata ad un oggetto del model
        $utenza = new Application_Model_Utenza();

        $utenza->nuovoUtente($elementi);




        //reindirizzo a gestione faq
        $this->getHelper('Redirector')->gotoSimple('gestioneutenti','livello3',$module=null);
    }


    /**
     *  Procedura di aggiornamento delle informazioni di un utente
     */
    public function updateutenteAction()
    {

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

        //se un utente viene degradato a utente semplice gli rimuovo la gestione degli edifici
        if($elementi['livello']<2){

            $edifici = new Application_Model_Edifici();
            $edifici->eliminaAssegnazioneByUtente($elementi['username']);
        }


        //reindirizzo a gestione utenti
        $this->getHelper('Redirector')->gotoSimple('gestioneutenti','livello3',$module=null);
    }


    /**
     *  Procedura che permette di eliminare un utente
     */
    public function eliminautenteAction()
    {

        $username=$this->getParam('username');

        $utenza = new Application_Model_Utenza();
        $utenza->deleteUtente($username);

        //reindirizzo a gestione utenti
        $this->getHelper('Redirector')->gotoSimple('gestioneutenti','livello3',$module=null);
    }

    /**
     * Metodo per assegnare un edifcio non precedentemente assegnato ad un utente
     */
    public function assegnaedificioautenteAction()
    {
        $username=$this->getParam('username');
        $edificio = $this->getParam('edificio');

        $gestione = new Application_Model_Edifici();
        $gestione->assegna($edificio,$username);

        //assegno l'username alla view
        //$this->view->assign('username',$username);


        //reindirizzo a gestione utenti
        $this->getHelper('Redirector')->gotoSimple('gestioneutenti','livello3',$module=null);
    }


    /**
     * Procedura di riassegnazione di un utente alla gestione di un edificio
     */
    public function eliminaeassegnaAction()
    {

        $edificio = $this->getParam('edificio');
        $username = $this->getParam('username');

        $gestione = new Application_Model_Edifici();

        $gestione->eliminaAssegnazione($edificio);

        $gestione->assegna($edificio,$username);

        //reindirizzo a gestione utenti
        $this->getHelper('Redirector')->gotoSimple('gestioneutenti','livello3',$module=null);


    }

    /**
     * Modifica delle informazioni dell'edificio nel db
     */
    public function submitmodificadescrizioneAction()
    {
        //metodo che non deve renderizzare niente come view
        $this->_helper->getHelper('layout')->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        // prendo dall' object request l'informazione sul vecchio nome dell'edificio
        // che corrisponde alla chiave d'accesso al db 
        $oldname = $this->getParam('oldname');

        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('error');
        }
        $post = $this->getRequest()->getPost();

        if (!$this->_modificaEdificioForm->isValid($post)) {
            $this->view->assign('msg', 'Inserimento dati errato! Controllare i campi');
            $this->view->assign('form', $this->_modificaEdificioForm);
            $this->render('error');
            return;
        }

        if (!$this->_modificaEdificioForm->mappa->receive()) {
            $this->view->assign('msg', 'Upload error');
            $this->view->assign('form', $this->_modificaEdificioForm);
            $this->render('error');
            return;
        }

        $values = $this->_modificaEdificioForm->getValues();


        $modelEdifici = new Application_Model_Edifici();
        $modelEdifici->updateEdificio($values,$oldname);
        $this->_helper->redirector('gestioneedifici'); //funziona
    }



}

