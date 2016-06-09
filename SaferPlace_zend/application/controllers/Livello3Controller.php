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
    protected $faqmodificaform = null;
    protected $faqcreaform = null;
    protected $modificadatiform = null;
    protected $_gestisciPianoForm = null;
    protected $_nuovoEdificioForm = null;
    protected $_modificaEdificioForm = null;
    protected $_nuovoPdfForm = null;

    protected $gestionezoneform;
    protected $inseriscizoneform;

    public function init()
    {
        $this->_helper->layout->setLayout('layout3');
        $this->_authService = new Application_Service_Auth();
        $this->user = $this->_authService->getAuth()->getIdentity()->current()->username;

        $this->_modificaEdificioForm = new Application_Form_Gestioneedificio();


        // -- model  --
        $this->_edificiModel = new Application_Model_Edifici();
        $this->view->arrayEdifici = $this->_edificiModel->getEdificiSet();

        $utenzaModell = new Application_Model_Utenti();
        $this->view->arrayUtenti = $utenzaModell->getUsers();

        $this->_faqModel = new Application_Model_Faq();
        $this->view->assign("faqSet", $this->_faqModel->getFaqSet());


        // -- form --

        //istanzio la form per l'inserimento di un edificio
        $this->_nuovoEdificioForm = $this->getNuovoEdificioForm();

        //istanzio la form per la modifica di un edificio
        $this->_nomeEd2 = $this->getParam('edificio2');
        $this->_modificaEdificioForm = $this->getModificaEdificioForm();

        //istanzio la form di aggiornamento di un utente
        $this->_aggiornaUtenteForm = new Application_Form_Gestisciutente();

        //assegno la form della creazione di un utente alla view
        $this->view->creautenteform = $this->getCreaUtenteForm(); //crea utente

        //assegno la form di gestione di un edificio alla view
        $this->view->formGestioneEdificio = $this->_edificioForm;

        $this->view->modificautenteform = $this->getAggiornaUtenteform();

        $this->view->modificaprofiloform=$this->getModificaDatiform(); //modifica del profilo

        $this->view->modificafaqform=$this->getModificaFaqForm(); //modifica delle faq

        $this->view->creafaqform=$this->getCreaFaqForm(); //crea una nuova faq

        $this->_gestisciPianoForm = $this->getInserisciPianoForm();

        $this->view->formInserisciPiani = $this->_gestisciPianoForm;

        $this->view->inseriscizoneform = $this->getInserisciZoneForm();

        if ($this->controllaParam('edificio') != null) {
            if ($this->controllaParam('numeroPiano') != null) {
                $this->view->formmodificapiano = $this->getModificaPianoForm();
            }
        }

        $this->view->zoneform = $this->getGestioneZonaForm();


        $this->_nuovoPdfForm = $this->getNewPdfForm();
        $this->view->nuovoPdfForm = $this->_nuovoPdfForm;
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
     *
     *
     */
    public function scegliedificioAction()
    {

        $username = $this->getParam('username');

        $edifici = new Application_Model_Edifici();
        $edificiNonAssegnati = $edifici->nonAssegnati();

        $edificiAssegnati = $edifici->getGestioni();

        $this->view->assign('edificiNonAssegnati', $edificiNonAssegnati);
        $this->view->assign('edificiAssegnati', $edificiAssegnati);
        $this->view->assign('username', $username);

    }

    /**
     * Popolo la schermata che permette di gestire un edificio
     *
     *
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
            $this->_aggiornaUtenteForm->populate($dati);

            $this->_aggiornaUtenteForm->setAction($urlHelper->url(array(
                'controller' => 'livello3',
                'action' => 'verificamodificautente'),
                'default'
            ));

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
        } else {
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
        $edificio = $this->controllaParam('edificio');
        $this->view->assign('edificio',$edificio);
    }

    protected function getModificaEdificioForm(){

        $urlHelper = $this->_helper->getHelper('url');

        $edificiModel                   = new Application_Model_Edifici();
        $this->_modificaEdificioForm    = new Application_Form_Gestioneedificio();

        $nomeEdificio       = $this->controllaParam('edificio');


        if ($nomeEdificio) {
                $infoEdificio = $edificiModel->getEdificio($nomeEdificio)->current();
                $data = array(

                    'nome' =>        $infoEdificio->nome,
                    'informazioni' => $infoEdificio->informazioni,
                    'mappa' => $infoEdificio->mappa,

                );

                $this->_modificaEdificioForm->populate($data);

                $this->_modificaEdificioForm->setAction($urlHelper->url(array(
                    'controller' => 'livello3',
                    'action' => 'verificamodificaedificio',
                    ),
                    'default'
                ));


                $this->view->formModificaEdificio = $this->_modificaEdificioForm;

                return $this->_modificaEdificioForm;
            }
        }


    public function verificamodificaedificioAction(){

        $edificio = $this->getParam('edificio');

        $request = $this->getRequest();
        if (!$request->isPost()) {
            return $this->_helper->redirector('gestioneedifici');
        }

        $form = $this->_modificaEdificioForm;

/*
        if (!$this->_modificaEdificioForm->mappa->receive()) {
            $this->view->assign('msg', 'Errore di upload');
            $this->view->assign('form', $this->_modificaEdificioForm);
            $this->view->assign('edificio',$edificio);
            $this->render('modificadescrizione');
            return;
        }
*/
        if (!$form->isValid($request->getPost())) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            $this->view->assign('edificio',$edificio);
            return $this->render('modificadescrizione');
        } else {

            $datiform=$this->_modificaEdificioForm->getValues();
            $edficiModel = new Application_Model_Edifici();
            $edifici = $edficiModel->getEdificiSet(); //prelevo l'insieme degli edifici presenti nel db per un controllo
            $check = 0;

            foreach ($edifici as $item){

                if($datiform['nome']!=$edificio && 0 == strcasecmp($item->nome,$datiform['nome'])  ) $check++;
            }

            if($check!=0) // se il nome è già resente nel db faccio partire l'errore
            {
                $form->setDescription('Attenzione: Nome edificio non disponibile.');
                $this->view->assign('edificio',$edificio);
                return $this->render('modificadescrizione');
            }
            else{

                $edficiModel->updateEdificio($datiform, $edificio);

                $vecchionome = $edificio;
                $nuovoNome   = $datiform['nome'];

                $this->rinominaEdificio($vecchionome,$nuovoNome);

                //reindirizzo a gestione edifici
                $this->getHelper('Redirector')
                    ->gotoSimple('modificaedificio','livello3',$module=null,array('edificio' => $datiform['nome']));
            }
        }
    }

    
    public function inserisciedificioAction()
    {
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
        $edificio = $this->getParam('edificio');
        
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
        $this->getHelper('Redirector')->gotoSimple('modificaedificio','livello3',$module=null,array('edificio'=>$edificio));
    }


    protected function getNuovoEdificioForm(){

        $this->_nuovoEdificioForm = new Application_Form_Gestioneedificio();

        $urlHelper = $this->_helper->getHelper('url');

        $this->_nuovoEdificioForm->setAction($urlHelper->url(array(
            'controller' => 'livello3',
            'action' => 'verificanuovoedificio'),
            'default'
        ));

        $this->view->nuovoEdificioForm = $this->_nuovoEdificioForm;


        return $this->_nuovoEdificioForm;


    }


    public function verificanuovoedificioAction()
    {

        $request = $this->getRequest();
        $urlHelper = $this->_helper->getHelper('url');
        if (!$request->isPost()) {
            return $this->_helper->redirector('gestioneedifici');
        }

        $form = $this->_nuovoEdificioForm;
        if (!$form->isValid($request->getPost())) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('inserisciedificio');
        }
        else
        {
            $datiform=$this->_nuovoEdificioForm->getValues(); //datiform è un array

            $edficiModel = new Application_Model_Edifici();
            $edifici = $edficiModel->getEdificiSet(); //prelevo l'insieme degli edifici presenti nel db per un controllo
            $check = 0;

            foreach ($edifici as $edificio){
                if(0 == strcasecmp($edificio->nome,$datiform['nome'])) $check++;
            }

            if($check!=0) // se il nome è già resente nel db faccio partire l'errore
            {
                $form->setDescription('Attenzione: Nome edificio non disponibile.');
                return $this->render('inserisciedificio');
            }
            else{

                $file = explode(".", $datiform['mappa']);
                $edificio = $datiform['nome'];
                $path1 = APPLICATION_PATH . '/../public/image/edifici/' . $datiform['mappa'];
                $path2 = APPLICATION_PATH . '/../public/image/edifici/' . $edificio ."." . end($file);
                rename($path1, $path2);

                $datiform['mappa'] = $edificio ."." . end($file);
                $edficiModel->nuovoEdifico($datiform);

                //reindirizzo a gestione utenti
                $this->getHelper('Redirector')->gotoSimple('gestioneedifici','livello3',$module=null);
            }
        }
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



    public function getModificaDatiform()
    {
        $urlHelper = $this->_helper->getHelper('url');

        $usermodel=new Application_Model_Utenti();

        $dati=$usermodel->getDatiUtenteByUserSet($this->user);
        $this->modificadatiform= new Application_Form_Registratiform();
        $this->modificadatiform->populate($dati);

        $this->modificadatiform->setAction($urlHelper->url(array(
            'controller' => 'livello3',
            'action' => 'verificamodificadati'),
            'default'
        ));
        $this->view->form1 = $this->modificadatiform;


        return $this->modificadatiform;
    }


    public function verificamodificadatiAction()
    {
        $request = $this->getRequest();
        /*if (!$request->isPost()) {
            return $this->_helper->redirector('modificadatiutente');
        }*/
        $form = $this->modificadatiform;
        $this->getHelper('ModificaProfilo')->verificaModifica($request,3,$form,$this->user);
    }

    public function eliminaedificioAction()
    {
        $edificio = $this->getParam('edificio');

        $model = new Application_Model_Edifici();
        $pianimodel = new Application_Model_Piani();
        $model->deleteEdifico($edificio);
        $piani = $pianimodel->getPianiByEdificio($edificio);
        foreach($piani as $item) {
            $this->pianoDelFiles($edificio, $item->numeroPiano);
        }

        $fileEdificio = glob(APPLICATION_PATH."/../public/image/edifici/".$edificio.".*" );
        unlink($fileEdificio[0]);

        //redireziono
        $this->_helper->redirector('gestioneedifici');
    }

    public function getInserisciPianoForm()
    {

        $urlHelper = $this->_helper->getHelper('url');

        $this->_gestisciPianoForm = new Application_Form_Gestionepiano();

        $this->_gestisciPianoForm->setAction(
            $urlHelper->url(array(

                'controller' => 'livello3',
                'action' => 'verificaiseriscipiano'),
                'default'
            )
        );


        return $this->_gestisciPianoForm;

    }

    public function inseriscipianoAction()
    {
        $this->view->edificio = $this->getParam('edificio');
    }

    public function verificaiseriscipianoAction()
    {

        $request = $this->getRequest();
        if (!$request->isPost()) {
            return $this->_helper->redirector('inseriscipiano');
        }

        $form = $this->_gestisciPianoForm;

        if (!$form->isValid($request->getPost())) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('inseriscipiano');
        } else {
            //inserisco nel db il piano

            $datiform = $this->_gestisciPianoForm->getValues();

            $edificio = $this->controllaParam('edificio');

            $modelPiani = new Application_Model_Piani();

            $file = explode(".", $datiform['pianta']);

            $path1 = APPLICATION_PATH . '/../public/image/piante/' . $datiform['pianta'];
            $path2 = APPLICATION_PATH . '/../public/image/piante/' . $edificio . " Piano " . $datiform['numeroPiano'] . "." . end($file);

            rename($path1, $path2);

            //controllo sui piani
            $piani = $modelPiani->getPianiByEdificio($edificio);
            $check = 0;

            foreach ($piani as $piano) {
                if ($piano['numeroPiano'] == $datiform['numeroPiano'])
                    $check++;
            }

            if ($check != 0) {
                $form->setDescription('Attenzione: Il piano inserito già esiste.');
                return $this->render('inseriscipiano'); //fine controllo sui piani

            } else {


                $modelPiani->nuovoPiano(array(

                    'edificio' => $edificio,
                    'numeroPiano' => $datiform['numeroPiano'],
                    'nstanze' => $datiform['nstanze'],
                    'pianta' => $edificio . " Piano " . $datiform['numeroPiano'] . "." . end($file)

                ));


                //reindirizzo a gestione utenti
                $this->getHelper('Redirector')->gotoSimple('modificaedificio', 'livello3', $module = null, array('edificio' => $edificio));
            }

        }
    }


    public function modificapianoAction()
    {
        $this->view->numeroPiano = $this->getParam('numeroPiano');
        $this->view->edificio = $this->getParam('edificio');
    }

    public function getModificaPianoForm()
    {

        $urlHelper = $this->_helper->getHelper('url');

        $this->modificapianoform = new Application_Form_Gestionepiano();

        $edificio = $this->getParam('edificio');
        $numeroPiano = $this->getParam('numeroPiano');


        $modelPiani = new Application_Model_Piani();

        $data = $modelPiani->getPiano($edificio, $numeroPiano);

        $this->modificapianoform->populate($data);

        $this->modificapianoform->setAction(
            $urlHelper->url(array(

                'controller' => 'livello3',
                'action' => 'verificamodificapiano'),
                'default'
            )
        );

        return $this->modificapianoform;
    }

    public function verificamodificapianoAction()
    {
        $edificio = $this->getParam('edificio');


        $request = $this->getRequest();

        if (!$request->isPost()) {
            return $this->_helper->redirector('modificapiano');
        }

        $form = $this->modificapianoform;
        if (!$form->isValid($request->getPost())) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            $this->view->assign('edificio', $edificio);
            return $this->render('modificapiano');
        } else {
            $datiform = $this->modificapianoform->getValues();

            $edificio = $this->controllaParam('edificio');
            $numeroPiano = $this->controllaParam('numeroPiano');

            $modelPiani = new Application_Model_Piani();

            if ($datiform['pianta'] != null) {
                $file = explode(".", $datiform['pianta']);

                $path1 = APPLICATION_PATH . '/../public/image/piante/' . $datiform['pianta'];
                $path2 = APPLICATION_PATH . '/../public/image/piante/' . $edificio . " Piano " . $datiform['numeroPiano'] . "." . end($file);

                rename($path1, $path2);
            }

            //controllo sui piani
            $piani = $modelPiani->getPianiByEdificio($edificio);
            $check = 0;

            foreach ($piani as $piano) {
                if ($piano['numeroPiano'] == $datiform['numeroPiano'])
                    $check++;
            }

            if ($check != 0 && $datiform['numeroPiano'] != $numeroPiano) {
                $form->setDescription('Attenzione: Il piano inserito già esiste.');
                return $this->render('modificapiano'); //fine controllo sui piani

            } else {
                $modelPiani = new Application_Model_Piani();

                $id = $modelPiani->getId($edificio, $numeroPiano)->current()->id;
                $modelPiani->updatePiano($datiform, $id);


                //reindirizzo a gestione utenti
                $this->getHelper('Redirector')->gotoSimple('modificaedificio', 'livello3', $module = null, array('edificio' => $edificio));
            }

            $this->getHelper('Redirector')->gotoSimple('index', 'livello3', $module = null);
        }


    }

    public function eliminazoneAction()
    {
        $adminModel = new Application_Model_Admin();
        $arrayedifici = $adminModel->getResource('Edifici')->getEdifici();

        if (($edificio = $this->controllaParam('edificio')) && ($piano = $this->controllaParam('piano')) &&
            (array_key_exists($edificio, $arrayedifici )) &&
            (in_array($piano, $this->getResource('Piani')->getPianiByEdificio($edificio) ))) {


            $adminModel->eliminaZonePiano($edificio,$piano);
        }



        $this->getHelper('Redirector')->gotoSimple('index', 'livello3', $module = null);
    }

    public function eliminadatizonaAction()
    {

        $adminModel = new Application_Model_Admin();
        $zone= $adminModel->getResource('Zona')->getZone();

        $arrayzone = array();
        foreach ($zone as $item){
            array_push($arrayzone, $item->id);
        }


        if (($zona = $this->controllaParam('zona')) && (in_array($zona, $arrayzone )) ) {

            $adminModel->eliminaZona($zona);
        }

        $this->getHelper('Redirector')->gotoSimple('index', 'livello3', $module = null);
    }


    public function eliminapianoAction()
    {
        $adminModel = new Application_Model_Admin();
        $edificio = $this->controllaParam('edificio');
        $numeroPiano = $this->controllaParam('numeroPiano');
        $adminModel->eliminaPiano($edificio, $numeroPiano);
        $this->pianoDelFiles($edificio, $numeroPiano);
        

        $this->getHelper('Redirector')->gotoSimple('modificaedificio', 'livello3', $module = null,
            array('edificio' => $edificio));

    }

    public function gestionepianifugaAction()
    {
        $edificio       = $this->controllaParam('edificio');
        $numeroPiano    = $this->controllaParam('numeroPiano');

        $modelAdmin = new Application_Model_Admin();
        $controllo = $modelAdmin->existsZone($edificio,$numeroPiano);

        //assegno le variabili alla view
        $this->view->edificio       = $edificio;
        $this->view->numeroPiano    = $numeroPiano;
        $this->view->controllo      = $controllo;

        //calcolo i piani di fuga di questo piano
        $modelPianoDiFuga = new Application_Model_PianoDiFuga();

        $pianiDiFuga = $modelPianoDiFuga->getByEdificioPiano($edificio,$numeroPiano);

        //assegno i piani di fuga alla view
        $this->view->pianiDiFuga = $pianiDiFuga;

    }

    public function verificanuovopdfAction()
    {
        $request = $this->getRequest();

        $edificio = $this->controllaParam('edificio');
        $numeroPiano = $this->controllaParam('numeroPiano');

        //controllo che nel database siano già state inserite le zone
        $modelAdmin = new Application_Model_Admin();
        $controllo = $modelAdmin->existsZone($edificio,$numeroPiano);
        if(!$controllo){
            $this->view->assign('edificio', $edificio);
            $this->view->assign('numeroPiano', $numeroPiano);
            $this->view->assign('controllo', $controllo);
            $this->getHelper('Redirector')->gotoSimple('gestionezone', 'livello3', $module = null, array(
                'edificio' => $edificio,
                'numeroPiano' => $numeroPiano,
                'controllo' => $controllo,
                'descrizione' => '0',
            ));
        }

        if (!$request->isPost()) {
            return $this->_helper->redirector('index');
        }

        $form = $this->_nuovoPdfForm;

        if (!$form->isValid($request->getPost())) {

            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');

            $this->ripopolapdf($edificio,$numeroPiano);

            $this->render('gestionepianifuga');

        } else {

            $datiform = $this->_nuovoPdfForm->getValues();

            $modelPianoDiFuga = new Application_Model_PianoDiFuga();


            //stacco l'estensione dal file per recuperarla all'atto della rinominazione
            $file = explode(".", $datiform['pianta']);

            $nomeFile = $edificio . " Piano " . $numeroPiano . " Uscite ". $datiform['nomePdf'];

            $path1 = APPLICATION_PATH . '/../public/image/piante/piani di fuga/' . $datiform['pianta'];
            $path2 = APPLICATION_PATH . '/../public/image/piante/piani di fuga/' . $nomeFile . "." . end($file); // l'ultimo pezzo è per l'estensione del file


            rename($path1, $path2);

            //controllo che non ci siano piani di fuga con lo stesso nome
            $pianiDiFuga = $modelPianoDiFuga->getByEdificioPiano($edificio,$numeroPiano);
            $check = 0;

            foreach ($pianiDiFuga as $pdf) {

                //stacco l'estensione dalla stringa
                $app = explode(".",$pdf->pianta);

                if ($nomeFile == $app[0]) {
                    $check++; //se i nomi corrispondono devo impedire l'inserimento
                }
            }

            if ($check) {
                $form->setDescription('Attenzione: Il piano di fuga inserito già esiste.');
                $this->ripopolapdf($edificio,$numeroPiano);
                return $this->render('gestionepianifuga'); //fine controllo sui piani

            } else {


                $modelPianoDiFuga->newPiano($nomeFile.".". end($file));
                //inserisco anche le assegnazioni
                $zone = $modelAdmin->getZoneByEdPiano($edificio,$numeroPiano);
                $pdfmodel = new Application_Model_PianoDiFuga();
                $idpdf = $pdfmodel->getPDF_desc();
                $datiassegnazione = null;
                $i = 0;
                foreach ($zone as $z){
                    $datiassegnazione[$i] = array(
                        'idPianoFuga' => $idpdf->current()->id,
                        'zona' => $zone->current()->id
                    );
                    $modelAdmin->insertAssegnazione($datiassegnazione[$i]);
                    $i++;
                }


                //reindirizzo a gestione piani di fuga
                $this->getHelper('Redirector')->gotoSimple('gestionepianifuga', 'livello3', $module = null,
                    array(
                        'edificio'      => $edificio,
                        'numeroPiano'   => $numeroPiano
                    ));

            }

            $this->getHelper('Redirector')->gotoSimple('index', 'livello3', $module = null);
        }


    }

    protected function getNewPdfForm(){

        $this->_nuovoPdfForm = new Application_Form_Nuovopdf();

        $urlHelper = $this->_helper->getHelper('url');

        $this->_nuovoPdfForm->setAction(
            $urlHelper->url(array(

                'controller' => 'livello3',
                'action' => 'verificanuovopdf'),
                'default'
            )
        );

        return $this->_nuovoPdfForm;
    }

    protected function ripopolapdf($edificio,$numeroPiano){

        $modelPianoDiFuga = new Application_Model_PianoDiFuga();
        $pianiDiFuga = $modelPianoDiFuga->getByEdificioPiano($edificio,$numeroPiano);

        //assegno i piani di fuga alla view
        $this->view->pianiDiFuga = $pianiDiFuga;
        $this->view->assign('edificio',$edificio);
        $this->view->assign('numeroPiano',$numeroPiano);
    }


    public function eliminapdfAction(){
        $modelAdmin = new Application_Model_Admin();
        $edificio = $this->getParam('edificio');
        $numeroPiano = $this->getParam('numeroPiano');
        $pianoDiFuga = $this->getParam('pdf');

        $modelAdmin->eliminaPianoFugaByNome($pianoDiFuga);

        //eliminafile
        $file = glob(APPLICATION_PATH . '/../public/image/piante/piani di fuga/' . $pianoDiFuga.".*");

        unlink($file[0]);

        $this->getHelper('Redirector')->gotoSimple('gestionepianifuga', 'livello3', $module = null, array(
            'edificio'      => $edificio,
            'numeroPiano'   => $numeroPiano
        ));

    }

    public function getGestioneZonaForm(){
        $urlHelper = $this->_helper->getHelper('url');

        //istanzio la form per modificare la faq
        $this->gestionezoneform = new Application_Form_Gestionezone();

        $this->gestionezoneform->setAction($urlHelper->url(array(
            'controller' => 'livello3',
            'action' => 'verificagestionezone'),
            'default'
        ));

        return $this->gestionezoneform;
    }

    public function getInserisciZoneForm(){

        $urlHelper = $this->_helper->getHelper('url');

        //istanzio la form per modificare la faq
        $this->inseriscizoneform = new Application_Form_Inseriscizone();

        $this->inseriscizoneform->setAction($urlHelper->url(array(
            'controller' => 'livello3',
            'action' => 'verificainseriscizone'),
            'default'
        ));

        return $this->inseriscizoneform;
    }

    public function verificainseriscizoneAction(){
        $request = $this->getRequest();
        $edificio       = $this->controllaParam('edificio');
        $numeroPiano    = $this->controllaParam('numeroPiano');

        if (!$request->isPost()) {
            return $this->_helper->redirector('gestionezone');
        }
        $form = $this->inseriscizoneform;

        if (!$form->isValid($request->getPost())) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            $modelAdmin = new Application_Model_Admin();
            $controllo = $modelAdmin->existsZone($edificio,$numeroPiano);
            $this->view->assign('edificio', $edificio);
            $this->view->assign('numeroPiano', $numeroPiano);
            $this->view->assign('controllo', $controllo);
            return $this->render('gestionezone');
        } else {
            $this->insertZone();
        }
    }

    public function verificagestionezoneAction()
    {
        $request = $this->getRequest();
        $edificio       = $this->controllaParam('edificio');
        $numeroPiano    = $this->controllaParam('numeroPiano');
        if (!$request->isPost()) {
            return $this->_helper->redirector('gestionezone');
        }
        $form = $this->gestionezoneform;
        if (!$form->isValid($request->getPost())) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            $modelAdmin = new Application_Model_Admin();
            $arrayPosizioni = $modelAdmin->getZoneByEdPianoIdasAlias($edificio,$numeroPiano);
            $this->view->assign('edificio', $edificio);
            $this->view->assign('numeroPiano', $numeroPiano);
            $this->view->assign('arrayPosizioni', $arrayPosizioni);
            $this->view->assign('controllo', true);

            return $this->render('gestionezone');
        } else {
            $this->insertPosizione();
        }
    }

    public function gestionezoneAction()
    {
        $edificio = $this->controllaParam('edificio');
        $numPiano = $this->controllaParam('numeroPiano');
        $descrizione=$this->controllaParam('descrizione');
        if($descrizione==0)
        {
            $descrizione='Devi prima inserire le zone al piano';
        }
        else
            $descrizione="";

        $modelAdmin = new Application_Model_Admin();
        $arrayPosizioni = $modelAdmin->getZoneByEdPianoIdasAlias($edificio,$numPiano);

        $controllo = $modelAdmin->existsZone($edificio,$numPiano); //controllo se nel database esiste già una suddivisione in zone del piano

        if (file_exists(APPLICATION_PATH . '/../public/image/piante/zone/' . $edificio . " Piano " . $numPiano.".jpg")) {
            $ext =  ".jpg";
        }
        else{
            $ext= ".png";
        }
        $this->view->assign('descrizione',$descrizione);
        $this->view->assign('edificio', $edificio);
        $this->view->assign('numeroPiano', $numPiano);
        $this->view->assign('ext', $ext);
        $this->view->assign('arrayPosizioni', $arrayPosizioni);
        $this->view->assign('controllo', $controllo);
    }

    public function insertPosizione(){
        $edificio       = $this->controllaParam('edificio');
        $numeroPiano    = $this->controllaParam('numeroPiano');

        $datiform = $this->gestionezoneform->getValues();
        $stanza = $datiform['stanza'];
        $alias = $datiform['zona'];
        $adminmodel = new Application_Model_Admin();

        $zona = $adminmodel->getIdZona($edificio, $numeroPiano,$alias)->current()->id;

        $posizionimodel = new Application_Model_Posizioni();
        $esisteposizione = $posizionimodel->existsPosizione($numeroPiano, $stanza,$edificio);
        $modelAdmin = new Application_Model_Admin();
        $arrayPosizioni = $modelAdmin->getZoneByEdPianoIdasAlias($edificio,$numeroPiano);

        if($esisteposizione){
            $this->gestionezoneform->setDescription('Attenzione: la posizione inserita è già esistente.');
            $this->view->assign('edificio', $edificio);
            $this->view->assign('numeroPiano', $numeroPiano);
            $this->view->assign('arrayPosizioni', $arrayPosizioni);
            $this->view->assign('controllo', true);

            return $this->render('gestionezone');

        }else{

            $posizionimodel->insertPosizione($zona,$stanza,$numeroPiano,$edificio);
            $this->getHelper('Redirector')->gotoSimple('gestionezone', 'livello3', $module = null, array('edificio' => $edificio, 'numeroPiano' => $numeroPiano,'arrayPosizioni' => $arrayPosizioni, 'controllo' => true));
        }
    }

    public function insertZone(){
        $edificio       = $this->controllaParam('edificio');
        $numeroPiano    = $this->controllaParam('numeroPiano');

        $datiform = $this->inseriscizoneform->getValues();
        $zone = explode(" ", $datiform['zone']);
        $adminmodel = new Application_Model_Admin();
        $i=0;

        foreach ($zone as $z){
            if($zone[$i] != null) {
                $dati[] = array('alias' => $z, 'edificio' => $edificio, 'Piano' => $numeroPiano);
                $adminmodel->insertZona($dati[$i]);
            }
            $i++;
        }
        $file = explode(".", $datiform['pianta']);
        $path1 = APPLICATION_PATH . '/../public/image/piante/zone/' . $datiform['pianta'];
        $path2 = APPLICATION_PATH . '/../public/image/piante/zone/' . $edificio . " Piano " . $numeroPiano . "." .$file[1];
        rename($path1, $path2);

        $arrayPosizioni = $adminmodel->getZoneByEdPianoIdasAlias($edificio,$numeroPiano);
        $this->getHelper('Redirector')->gotoSimple('gestionezone', 'livello3', $module = null, array('edificio' => $edificio, 'numeroPiano' => $numeroPiano,'arrayPosizioni' => $arrayPosizioni));

    }

    public function eliminaposizioneAction(){
        $stanza= $this->getParam('stanza');
        $numPiano= $this->getParam('numPiano');
        $edificio= $this->getParam('edificio');

        $posizionemodel = new Application_Model_Posizioni();
        $id = $posizionemodel->getIdPosizioniByNumPianoStanzaEdificioSet($numPiano,$stanza,$edificio)->current()->id;

        $posizionemodel->delPosizioni($id);
        $modelAdmin = new Application_Model_Admin();
        $arrayPosizioni = $modelAdmin->getZoneByEdPianoIdasAlias($edificio,$numPiano);
        //reindirizzo a gestione utenti
        $this->getHelper('Redirector')->gotoSimple('gestionezone', 'livello3', $module = null, array('edificio' => $edificio, 'numeroPiano' => $numPiano, 'arrayPosizioni' => $arrayPosizioni));
    }


    /**
     * Rinomino tutti i file e le occorrenze del db collegate ad un deerminato edificio
     * @param $nome_vecchio_edificio
     * @param $nome_nuovo_edificio
     */
    protected function rinominaEdificio($nome_vecchio_edificio,$nome_nuovo_edificio){

        //model
        $edificioModel  = new Application_Model_Edifici();
        $posizioniModel = new Application_Model_Posizioni();
        $pianiModel     = new Application_Model_Piani();
        $pdfModel       = new Application_Model_PianoDiFuga();
        $adminModel      = new Application_Model_Admin();
        $stringa_esplosa = null;

        //edificio

        $set = $edificioModel->getEdificio($nome_nuovo_edificio); //attenzione  [0]
        $mappa_vecchio_edificio = $set[0]->mappa;
        $stringa_esplosa = explode(".", $mappa_vecchio_edificio);

        //rinomino il file corrispondente
        $file1 = APPLICATION_PATH . '/../public/image/edifici/' . $mappa_vecchio_edificio;
        $nuovoNomeFile = $nome_nuovo_edificio . "." . end($stringa_esplosa);
        $file2 = APPLICATION_PATH . '/../public/image/edifici/' . $nuovoNomeFile;
        rename($file1, $file2);


        $edificioModel->updateEdificio(array('mappa' => $nuovoNomeFile), $nome_nuovo_edificio);

        //aggiorno le posizioni nel db
        $posizioniModel->updateByEdificio($nome_vecchio_edificio,array(
            'edificio' => $nome_nuovo_edificio
        ));

        //aggiorno la zona nel db
        $adminModel->updateZoneByEdificio($nome_vecchio_edificio,array(
            "edificio"  => $nome_nuovo_edificio
        ));

        //pianta

        $pianiset = $pianiModel->getPianiByEdificio($nome_nuovo_edificio);

        foreach ($pianiset as $item){

            //prelevo la pianta vecchia
            $vecchiaPianta = $item->pianta;
            $pianta_esplosa = explode("Piano",$vecchiaPianta);

            $nuovaPianta = $nome_nuovo_edificio . " Piano".end($pianta_esplosa);

            //aggiorno nel db
            $pianiModel->updatePianiByPianta($vecchiaPianta,array(
                "pianta" => $nuovaPianta
            ));

            //rinomino il file
            $file1 = APPLICATION_PATH . '/../public/image/piante/' . $vecchiaPianta;
            $file2 = APPLICATION_PATH . '/../public/image/piante/' . $nuovaPianta;
            rename($file1, $file2);

            //mappature
            $file_vecchia_mappa = $nome_vecchio_edificio . " Piano " .$item->numeroPiano . ".txt";
            $file_nuova_mappa = $nome_nuovo_edificio . " Piano " . $item->numeroPiano . ".txt";
            $path1 = APPLICATION_PATH . '/../public/image/piante/map/' . $file_vecchia_mappa;
            $path2 = APPLICATION_PATH . '/../public/image/piante/map/' . $file_nuova_mappa;
            if(file_exists($path1)){
                rename($path1,$path2);
            }

            //piani di fuga
            print_r($item->numeroPiano.'<br>');

            $setpdf = $pdfModel->getByEdificioPiano($nome_vecchio_edificio,$item->numeroPiano);

            //per ogni piano di fuga colledato ad un determinato piano
            foreach ($setpdf as $pdf){

                //modifico l'occorenza nel db
                $vecchiaPiantaPdf   = $pdf->pianta;
                $vecchiaPiantaEsplosa = explode("Piano",$vecchiaPiantaPdf);
                $nuovaPiantaPdf     = $nome_nuovo_edificio . " Piano" .end($vecchiaPiantaEsplosa);

                $pdfModel->updateByPianta($vecchiaPiantaPdf,array(
                    'pianta' => $nuovaPiantaPdf
                ));

                //aggiorno il file

                $path1 = APPLICATION_PATH . '/../public/image/piante/piani di fuga/' . $vecchiaPiantaPdf;
                $path2 = APPLICATION_PATH . '/../public/image/piante/piani di fuga/' . $nuovaPiantaPdf;

                if(file_exists($path1)){
                    rename($path1,$path2);
                }
            }


            //zone

            $file_vecchia_zona_jpg = $nome_vecchio_edificio . " Piano " . $item->numeroPiano . ".jpg";
            $file_vecchia_zona_png = $nome_vecchio_edificio . " Piano " . $item->numeroPiano . ".png";
            $file_nuova_zona_jpg = $nome_nuovo_edificio. " Piano " . $item->numeroPiano . ".jpg";
            $file_nuova_zona_png = $nome_nuovo_edificio . " Piano " . $item->numeroPiano . ".png";

            $path_old_jpg = APPLICATION_PATH . '/../public/image/piante/zone/' . $file_vecchia_zona_jpg;
            $path_old_png = APPLICATION_PATH . '/../public/image/piante/zone/' . $file_vecchia_zona_png;
            $path_new_jpg = APPLICATION_PATH . '/../public/image/piante/zone/' . $file_nuova_zona_jpg;
            $path_new_png = APPLICATION_PATH . '/../public/image/piante/zone/' . $file_nuova_zona_png;


            //controllo se ho un file in jpg
            if(file_exists($path_old_jpg)){
                //aggiorno in jpg
                rename($path_old_jpg,$path_new_jpg);
            }

            //controllo se ho un file in png
            if(file_exists($path_old_png)){
                //aggiorno in png
                rename($path_old_png,$path_new_png);
            }

        }
    }


    public function modificadatiutenteAction()
    {
    }


    public function cancellazonaAction(){
        $edificio       = $this->controllaParam('edificio');
        $numeroPiano    = $this->controllaParam('numeroPiano');
        $modelAdmin = new Application_Model_Admin();
        $modelAdmin->eliminaZonePiano($edificio,$numeroPiano);

        $nomeImmagine = ''.$edificio.' Piano '.$numeroPiano.'';
        $file = glob(APPLICATION_PATH . '/../public/image/piante/zone/'.$nomeImmagine.'.*');

        unlink($file[0]);

        $controllo = $modelAdmin->existsZone($edificio,$numeroPiano);

        $this->view->assign('edificio', $edificio);
        $this->view->assign('numeroPiano', $numeroPiano);
        $this->view->assign('controllo', $controllo);

        return $this->render('gestionezone');
    }


    private function pianoDelFiles($edificio,$numeroPiano){
        $filesPdf  = glob(APPLICATION_PATH . '/../public/image/piante/piani di fuga/'.$edificio . ' Piano ' . $numeroPiano.'*');
        $filesZone  = glob(APPLICATION_PATH . '/../public/image/piante/zone/'.$edificio . ' Piano ' . $numeroPiano.'*');
        $filesPiano  = glob(APPLICATION_PATH . '/../public/image/piante/'.$edificio . ' Piano ' . $numeroPiano.'*');

        //elimino i files
        foreach ($filesPdf as $item){
            unlink($item);
        }

        foreach ($filesZone as $item){
            unlink($item);
        }

        foreach ($filesPiano as $item){
            unlink($item);
        }


    }




}











