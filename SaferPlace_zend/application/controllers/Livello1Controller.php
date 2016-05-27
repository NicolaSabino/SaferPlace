<?php

class Livello1Controller extends Zend_Controller_Action
{

    protected $stanzaform;
    protected $modificaform;

    public function init()
    {
        $this->_helper->layout->setLayout('layout1');
        $this->view->modificaform=$this->getModificaform();
    }

    public function reinderizzaErroreAction($stanza, $edificio, $numPiano, $azione)
    {
        //controlla che la stanza sia stata scelta dalla select, se non viene scelta si ricarica la pagina
        if($stanza==0) {
            $action = $azione;
            $controller = 'livello1';
            $params = array('edificio'=>$edificio,
                'numPiano'=>$numPiano,
                'errore'=>'errore'); //aggiunge all'url un parametro "errore" che permetterà di visualizzare un messaggio di errore

            $this->getHelper('Redirector')->gotoSimple($action, $controller, $module = null, $params);
        }
    }

    public function inseriscidatiposizioneAction()
    {

        $user="Peppep94";
        $numPiano=$this->controllaParam('numPiano');
        $edificio=$this->controllaParam('edificio');
        $stanza=$this->controllaParam('elencostanze');

        $this->reinderizzaErroreAction($stanza, $edificio, $numPiano,'checkinb');

        $idposizione=new Application_Model_Posizioni();
        $posizioni=$idposizione->getIdPosizioniByNumPianoStanzaEdificioSet($numPiano, $stanza,$edificio);

        $collocazionemodel=new Application_Model_Collocazioni();
        $collocazione=$collocazionemodel->getCollocazioneByUserSet($user);

        if($collocazione===array() )
        {
            $collocazionemodel->insertCollocazioni($user,$posizioni->current()->id );
        }
        else
        {
            $collocazionemodel->updateCollocazioni($posizioni->current()->id,$user);
        }

        $this->getHelper('Redirector')->gotoSimple('index','livello1', $module = null, array('edificio'=>$edificio,
            'numPiano'=>$numPiano,
            'stanza'=>$stanza));

    }

    public function inseriscidatisegnalazioneAction()
    {

        $user="Peppep94";
        $numPiano=$this->controllaParam('numPiano');
        $edificio=$this->controllaParam('edificio');
        $evento=$this->controllaParam('evento');
        $stanzasegnalata=$this->controllaParam('segnalastanza');

        $collocazionemodel=new Application_Model_Collocazioni();
        $collocazione=$collocazionemodel->getCollocazioneByUserSet($user);

        $posizionemodel=new Application_Model_Posizioni();
        $posizioni=$posizionemodel->getPosizioniByIdSet($collocazione->current()->idPosizione);

        $stanza=$posizioni->current()->stanza;

        $this->reinderizzaErroreAction($stanzasegnalata, $edificio, $numPiano, 'caricamappasegnalazione');

        $idPosizione = $posizionemodel->getIdPosizioniByNumPianoStanzaEdificioSet($numPiano,$stanzasegnalata,$edificio);

        $segnalazionemodel = new Application_Model_Segnalazioni();
        $segnalazionemodel->insertSegnalazioni($user, $idPosizione->current()->id, $evento);

        $this->getHelper('Redirector')->gotoSimple('index','livello1', $module = null, array('edificio'=>$edificio,
            'numPiano'=>$numPiano,
            'stanza'=>$stanza));

    }

    public function indexAction()
    {
        $numPiano=$this->controllaParam('numPiano');
        $edificio=$this->controllaParam('edificio');
        $stanza=$this->controllaParam('stanza');

        $this->view->arrayInformazioni = array('stanza'=>$stanza,'numPiano'=>$numPiano,'edificio'=>$edificio);

    }

    /**
     * action che carica la view del checkin
     */
    public function checkinAction()
    {
        $edificimodel = new Application_Model_Edifici();
        $edifici = $edificimodel->getEdificiSet();
        $this->view->insiemeEdifici = $edifici;
    }

    /**
     * action che carica la view del checkin intermedio per la scelta del piano
     */
    public function checkinintAction()
    {
        $edificio=$this->controllaParam('edificio');


        $edificimodel = new Application_Model_Edifici();
        $edifici = $edificimodel->getEdificiSet();
        $this->view->insiemeEdifici = $edifici;


        $pianimodel=new Application_Model_Piani();
        $piani = $pianimodel->getPianiByEdificio($edificio);
        $this->view->insiemePiani = $piani;
    }

    /**
     * action che carica la view del checkin B per la scelta della stanza
     */
    public function checkinbAction()
    {
        $edificio=$this->controllaParam('edificio');
        $numPiano=$this->controllaParam('numPiano');
        $errore=$this->controllaParam('errore'); //variabile usata per mostrare a video un messaggio di errore 
 
        $this->view->insiemePiani = $numPiano;
        $this->view->insiemeEdifici = $edificio;
        $this->view->errore = $errore;




        $_stanzeModel = new Application_Model_Piani();

        $numStanze = $_stanzeModel->getNStanzeByPianoSet($edificio, $numPiano);


        $app = 0 ; //variabile appoggio per il numero delle stanze di un piano
        foreach ($numStanze as $nStanze){
            $app = $nStanze->nstanze;
        }


        $this->stanzaform= new Application_Form_Selezionastanza($app);

        $this->stanzaform->setAction($this->view->url(
            array(
                'controller' => 'livello1',
                'action' => 'inseriscidatiposizione',
            )
        ));

        $this->view->formstanza=$this->stanzaform;
    }

    public function segnalazioneAction()
    {
        // action body
    }

    public function caricamappasegnalazioneAction()
    {
        $idPosizionemodel=new Application_Model_Collocazioni();
        $idPosizione=$idPosizionemodel->getCollocazioneByUserSet('Peppep94');

        $numPianoEdificiomodel=new Application_Model_Posizioni();
        $numPianoEdificio=$numPianoEdificiomodel->getPosizioniByIdSet($idPosizione->current()->idPosizione);

        $this->view->numPianoEdificio=$numPianoEdificio;
        $errore=$this->controllaParam('errore'); //variabile usata per mostrare a video un messaggio di errore 
        $this->view->errore = $errore;

        $_stanzeModel = new Application_Model_Piani();

        $numStanze = $_stanzeModel->getNStanzeByPianoSet($numPianoEdificio->current()->edificio, $numPianoEdificio->current()->numPiano);


        $app = 0 ; //variabile appoggio per il numero delle stanze di un piano
        foreach ($numStanze as $nStanze){
            $app = $nStanze->nstanze;
        }


        $this->segnalaform= new Application_Form_Segnalaform($app);


        $this->segnalaform->setAction($this->view->url(
            array(
                'controller' => 'livello1',
                'action' => 'inseriscidatisegnalazione',
                'edificio'=>$numPianoEdificio->current()->edificio,
                'numPiano'=>$numPianoEdificio->current()->numPiano
            )
        ));

        $this->view->segnalaform=$this->segnalaform;


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

    public function visualizzafugaAction()
    {
        $user="Peppep94";

        $collocazionemodel=new Application_Model_Collocazioni();
        $collocazione=$collocazionemodel->getCollocazioneByUserSet($user);

        $posizionemodel=new Application_Model_Posizioni();
        $posizioni=$posizionemodel->getPosizioniByIdSet($collocazione->current()->idPosizione);

        $assegnazionemodel=new Application_Model_Assegnazione();
        $assegnazione=$assegnazionemodel->getAssegnazioneByZonaSet($posizioni->current()->zona);

        $pianoDiFugamodel=new Application_Resource_PianoDiFuga();
        $pianoDiFuga=$pianoDiFugamodel->getPianiDiFugaByid($assegnazione->current()->idPianoFuga);

        $this->view->pianta=$pianoDiFuga->current()->pianta;
        


    }

    public function modificadatiutenteAction()
    {
        $user='Peppep94';

        $usermodel=new Application_Model_Utenti();
        $dati=$usermodel->getDatiUtenteByUserSet($user);
        $this->modificaform= new Application_Form_Registratiform($dati);

        $this->modificaform->setAction($this->view->url(
            array(
                'controller' => 'livello1',
                'action' => '',
            )
        ));

        $this->view->modificaform=$this->modificaform;
    }


  public function getModificaform()
  {
      $urlHelper = $this->_helper->getHelper('url');
      $this->modificaform=new Application_Form_Loginform();

      $this->modificaform->setAction($urlHelper->url(array(
          'controller' => 'index',
          'action' => 'verificaModifica'),
          'default'
      ));
      return $this->modificaform;
  }

    public function verificaModificaAction()
    {
        $request = $this->getRequest();
        if (!$request->isPost()) {
            return $this->_helper->redirector('modificadatiutente');
        }
        $form = $this->modificaform;
        if (!$form->isValid($request->getPost())) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('modificadatiutente');
        }
        else
        {
            $datiform=$this->modificaform->getValues(); //datiform è un array

            $utentimodel=new Application_Model_Utenti();

            $username=$this->controllaParam('username'); //prendo l'username inserito nella form

            if($utentimodel->existUsername($username)) //controllo se l'username inserito esiste già nel db
            {
                $form->setDescription('Attenzione: l\'username che hai scelto non è disponibile.');
                return $this->render('modificadatiutente');
            }
            else{
                $utentimodel->updateUtentiSet($datiform);
                $this->getHelper('Redirector')->gotoSimple('index','livello1', $module = null);
            }
        }
    }

}



















