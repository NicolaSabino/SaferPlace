<?php

class Livello3Controller extends Zend_Controller_Action
{

    protected $_edificiModel = null;

    protected $_creautenteform = null;

    protected $_utenzaModel = null;

    protected $_faqModel = null;

    protected $_edificioForm = null;

    protected $_aggiornaUtenteForm = null;

    protected $user = null;

    protected $_authService = null;

    protected $faqmodificaform;

    protected $faqcreaform;

    protected $modificadatiform;

    public function init()
    {
        $this->_helper->layout->setLayout('layout3');
        $this->_authService = new Application_Service_Auth();
        $this->user=$this->_authService->getAuth()->getIdentity()->current()->username;

        $this->_modificaEdificioForm = new Application_Form_Gestioneedificio();

        $this->_edificiModel = new Application_Model_Edifici();
        $this->view->arrayEdifici = $this->_edificiModel->getEdificiSet();

        $utenzaModell = new Application_Model_Utenti();
        $this->view->arrayUtenti = $utenzaModell->getUsers();

        $this->_faqModel = new Application_Model_Faq();
        $this->view->assign("faqSet",$this->_faqModel->getFaqSet());


        //istanzio la form di modifica di un edificio
        $this->_edificioForm = new Application_Form_Gestioneedificio();

        //assegno la form della creazione di un utente alla view
        $this->view->registratiform = $this->getCreaUtenteForm();

        $this->_aggiornaUtenteForm = $this->getAggiornaUtenteform();

        $this->modificadatiform=$this->getModificaDatiform(); //modifica del profilo

        $this->faqmodificaform=$this->getModificaFaqForm();

        $this->faqcreaform=$this->getCreaFaqForm();

    }

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
     *  Popola la schermata che permette all'admin di gestire le assegnazioni dello
     * staff
     * 
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
     * 
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

    public function getModificaFaqForm()
    {
        $urlHelper = $this->_helper->getHelper('url');

        $domanda=$this->getParam("domanda");
        $risposta=$this->getParam("risposta");
        $id=$this->getParam("id");
        $this->view->id = $id;

        $this->faqmodificaform=new Application_Form_ModificaFaq($domanda,$risposta,$id);
        $this->faqmodificaform->populate($domanda,$risposta);

        $this->faqmodificaform->setAction($urlHelper->url(array(
            'controller' => 'livello3',
            'action' => 'verificamodificafaq'),
            'default'
        ));

        $this->view->faqForm=$this->faqmodificaform;

        return $this->faqmodificaform;
    }

    public function verificamodificafaqAction(){
        $request = $this->getRequest();
        //istanzio la form di registrazione di un nuovo utente

        if (!$request->isPost()) {
            return $this->_helper->redirector('modificafaq');
        }

        $form = $this->faqmodificaform;

        if (!$form->isValid($request->getPost())) {
            $form->setDescription('Attenzione: Compila tutti i campi.');
            return $this->render('modificafaq');
        }
        else {
            $this->updatefaq();
        }
    }

    /**
     * Predispone la form per modificare una faq
     * 
     */
    public function modificafaqAction()
    {
    }


    public function getCreaFaqForm()
    {
        $urlHelper = $this->_helper->getHelper('url');

        //istanzio la form per modificare la faq
        $this->faqcreaform = new Application_Form_ModificaFaq();

        $this->faqcreaform->setAction($urlHelper->url(array(
            'controller' => 'livello3',
            'action' => 'verificacreafaq'),
            'default'
        ));

        return $this->faqcreaform;
    }

    public function verificacreafaqAction(){
        $request = $this->getRequest();
        //istanzio la form di registrazione di un nuovo utente

        if (!$request->isPost()) {
            return $this->_helper->redirector('creafaq');
        }

        $form = $this->faqcreaform;
        if (!$form->isValid($request->getPost())) {
            $form->setDescription('Attenzione: Compila tutti i campi.');
            return $this->render('creafaq');
        }
        else {

            $this->insertfaq();

        }
    }

    /**
     * Predispongo la form per inserire una nuova faq
     * 
     */
    public function creafaqAction()
    {

        //assegno la form alla view
        $this->view->faqForm=$this->faqcreaform;
    }

    public function getCreaUtenteForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_creautenteform=new Application_Form_Registratiform();

        $this->_creautenteform->setAction($urlHelper->url(array(
            'controller' => 'livello3',
            'action' => 'verificacreautente'),
            'default'
        ));

        return $this->_creautenteform;
    }

    public function verificacreautenteAction()
    {

        $request = $this->getRequest();
        //istanzio la form di registrazione di un nuovo utente

        if (!$request->isPost()) {
            return $this->_helper->redirector('creautente');
        }

        $form = $this->_creautenteform;

        if (!$form->isValid($request->getPost())) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('creautente');
        }
        else
        {
            $datiform=$this->_creautenteform->getValues(); //datiform è un array

            $utentimodel=new Application_Model_Utenti();

            $username=$this->controllaParam('username'); //prendo l'username inserito nella form

            if($utentimodel->existUsername($username)) //controllo se l'username inserito esiste già nel db
            {
                $form->setDescription('Attenzione: l\'username che hai scelto non è disponibile.');
                return $this->render('creautente');
            }
            else{
                $utentimodel->insertUtenti($datiform);
                $this->getHelper('Redirector')->gotoSimple('gestioneutenti','livello3', $module = null);
            }

        }
    }

    public function creautenteAction()
    {
    }

    public function getAggiornaUtenteform()
    {
        $urlHelper = $this->_helper->getHelper('url');

        $usermodel=new Application_Model_Utenti();
        $username = $this->controllaParam('username');

        if ($username!=null) {
            $dati = $usermodel->getDatiUtenteByUserSet($username);
            $this->_aggiornaUtenteForm = new Application_Form_Gestisciutente($dati);
            $this->_aggiornaUtenteForm->populate($dati);

            $this->_aggiornaUtenteForm->setAction($urlHelper->url(array(
                'controller' => 'livello3',
                'action' => 'verificamodificautente'),
                'default'
            ));

            $this->view->form = $this->_aggiornaUtenteForm;

            return $this->_aggiornaUtenteForm;
        }
    }

    public function verificamodificautenteAction()
    {
        $request = $this->getRequest();
        if (!$request->isPost()) {
            return $this->_helper->redirector('modificautente');
        }
        $form = $this->_aggiornaUtenteForm;
        if (!$form->isValid($request->getPost())) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('modificautente');
        }
        else
        {
            $this->updateutente();

        }
    }

    /**
     * Procedura che predispone la form di aggiornamento delle informazioni di un
     * utente
     * 
     */
    public function modificautenteAction()
    {
    }

    /**
     *  Creo la view con relativa form che permette di modificare NOME INFORMAZIONI E
     * IMMAGINE di un edificio
     * 
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

        //popolo la form
        $this->_edificioForm->populate($data);

        //imposto l'azione della form
        $this->_edificioForm->setAction($this->view->url(
            array(
                'controller'    => 'livello3',
                'action'        => 'submitmodificadescrizione',
                'oldname'       => $nomeEdificio
            )
        ));

        //assegno la form alla view

        $this->view->assign('Form',$this->_edificioForm);
        //assegno il nome dell'edificio alla view per il bottone indietro
        $this->view->assign('nomeEdificio',$nomeEdificio);
        
        
        return $this->_edificioForm;
        
        
    }

    /**
     * popolo la form di inserimento di un nuovo edificio
     */
    public function inserisciedificioAction()
    {
        //imposto l'azione della form
        $this->_edificioForm->setAction($this->view->url(
            array(
                'controller'    => 'livello3',
                'action'        => 'nuovoedificio',
            )
        ));

        //passo l'occorrenza della form alla view
        $this->view->assign('Form',$this->_edificioForm);


        return $this->_edificioForm;
    }

    /**
     * aggiorno una faq nel db
     * 
     */
    public function updatefaq()
    {
        $datiform = $this->faqmodificaform->getValues();
        $dom=$datiform['domanda'];
        $risp=$datiform['risposta'];
        $idFaq=$datiform['id'];


        $this->_faqModel = new Application_Model_Faq();
        $this->_faqModel->setFaq($dom,$risp,$idFaq);

        //reindirizzo a gestione faq
        $this->getHelper('Redirector')->gotoSimple('gestionefaq','livello3',$module=null);
    }

    /**
     * Metodo che inserisce una faq nel db
     * 
     */
    public function insertfaq()
    {
        $datiform = $this->faqcreaform->getValues();

        $dom=$datiform['domanda'];
        $risp=$datiform['risposta'];

        $this->_faqModel = new Application_Model_Faq();
        $this->_faqModel->newFaq($dom,$risp);

        //reindirizzo a gestione faq
        $this->getHelper('Redirector')->gotoSimple('gestionefaq','livello3',$module=null);

    }

    /**
     * metodo che elimina una faq dal db
     * 
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
     * 
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
        $utenza = new Application_Model_Utenti();

        $utenza->insertUtenti($elementi);




        //reindirizzo a gestione faq
        $this->getHelper('Redirector')->gotoSimple('gestioneutenti','livello3',$module=null);
    }

    /**
     *  Procedura di aggiornamento delle informazioni di un utente
     * 
     */
    public function updateutente()
    {
        $datiform=$this->_aggiornaUtenteForm->getValues();

        $utente = new Application_Model_Utenti();

        if($utente->existUsername($datiform['username']) && $datiform['username'] != $this->getParam('username')) //controllo se l'username inserito esiste già nel db
        {
            $this->_aggiornaUtenteForm->setDescription('Attenzione: l\'username che hai scelto non è disponibile.');
            return $this->render('modificautente');
        }
        else {
            $utente->updateUtentiAdmin($datiform, $this->getParam('username'));

            //se un utente viene degradato a utente semplice gli rimuovo la gestione degli edifici
            if ($datiform['livello'] < 2) {

                $edifici = new Application_Model_Edifici();
                $edifici->eliminaAssegnazioneByUtente($datiform['username']);
            }
            //reindirizzo a gestione utenti
            $this->getHelper('Redirector')->gotoSimple('gestioneutenti', 'livello3', $module = null);
        }
    }

    /**
     *  Procedura che permette di eliminare un utente
     * 
     */
    public function eliminautenteAction()
    {

        $username=$this->getParam('username');

        $utenza = new Application_Model_Utenti();
        $utenza->deleteUtente($username);

        //reindirizzo a gestione utenti
        $this->getHelper('Redirector')->gotoSimple('gestioneutenti','livello3',$module=null);
    }

    /**
     * Metodo per assegnare un edifcio non precedentemente assegnato ad un utente
     * 
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
     * 
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
     * 
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

        if (!$this->_edificioForm->isValid($post)) {
            $this->view->assign('msg', 'Inserimento dati errato! Controllare i campi');
            $this->view->assign('form', $this->_modificaEdificioForm);
            $this->render('error');
            return;
        }

        if (!$this->_edificioForm->mappa->receive()) {
            $this->view->assign('msg', 'Upload error');
            $this->view->assign('form', $this->_modificaEdificioForm);
            $this->render('error');
            return;
        }

        $values = $this->_edificioForm->getValues();
        

        $modelEdifici = new Application_Model_Edifici();
        $modelEdifici->updateEdificio($values,$oldname);
        $this->_helper->redirector('gestioneedifici'); //funziona
    }

    /**
     * Inserisco un nuovo edificio nel database
     */
    public function nuovoedificioAction()
    {

        //metodo che non deve renderizzare niente come view
        $this->_helper->getHelper('layout')->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('error');
        }
        $post = $this->getRequest()->getPost();


        if (!$this->_edificioForm->isValid($post)) {
            $this->view->assign('msg', 'Inserimento dati errato! Controllare i campi');
            $this->view->assign('form', $this->_edificioForm);
            $this->render('error');
            return;
        }


        $values = $this->_edificioForm->getValues();


        $modelEdifici = new Application_Model_Edifici();
        $modelEdifici->nuovoEdifico($values);

        //reindirizzo a gestione utenti
        $this->getHelper('Redirector')->gotoSimple('gestioneedifici','livello3',$module=null);

    }

    /**
     * controlla se vengono passati dei parametri e restituisce il parametro
     * passato per riferimento
     * 
     * @param $param
     * @return int|mixed
     */
    public function controllaParam($param)
    {
        $parametro=0;
        if($this->hasParam("$param"))
            $parametro=$this->getParam("$param");
        return $parametro;
    }



    public function modificadatipersonaliAction()
    {
    }


    public function getModificaDatiform()
    {
        $urlHelper = $this->_helper->getHelper('url');

        $usermodel=new Application_Model_Utenti();
        $dati=$usermodel->getDatiUtenteByUserSet($this->user);
        $this->modificadatiform= new Application_Form_Registratiform($dati);
        $this->modificadatiform->populate($dati);

        $this->modificadatiform->setAction($urlHelper->url(array(
            'controller' => 'livello3',
            'action' => 'verificamodificaDati'),
            'default'
        ));
        $this->view->form1 = $this->modificadatiform;


        return $this->modificadatiform;
    }

    public function verificamodificaDatiAction()
    {
        $request = $this->getRequest();
        if (!$request->isPost()) {
            return $this->_helper->redirector('modificadatipersonali');
        }
        $form = $this->modificadatiform;
        if (!$form->isValid($request->getPost())) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('modificadatipersonali');
        }
        else
        {
            $datiform=$this->modificadatiform->getValues(); //datiform è un array

            $utentimodel=new Application_Model_Utenti();
            $username = $this->user;

            if($utentimodel->existUsername($datiform['username']) && $datiform['username'] != $this->getParam('username')) //controllo se l'username inserito esiste già nel db
            {
                $form->setDescription('Attenzione: l\'username che hai scelto non è disponibile.');
                return $this->render('modificadatiutente');
            }

            else{
                $utentimodel->updateUtentiSet($datiform, $username);
                //aggiorna l'username alla sessione
                $this->_authService->getAuth()->getIdentity()->current()->username = $datiform['username'];
                $this->getHelper('Redirector')->gotoSimple('index','livello3', $module = null);
            }
        }
    }


}





