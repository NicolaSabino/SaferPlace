<?php

class Livello1Controller extends Zend_Controller_Action
{

    protected $stanzaform;
    protected $modificaform;
    protected $_stanza;
    protected $_numPiano;
    protected $_edificio;
    protected $user;
    protected $livello;
    protected $_authService;

    public function controlladatiAction(){

        $collocazionemodel=new Application_Model_Collocazioni();
        $collocazione=$collocazionemodel->getCollocazioneByUserSet($this->user);

        if(!$collocazione->current()==null) {
            
            $posizionemodel = new Application_Model_Posizioni();
            $posizioni = $posizionemodel->getPosizioniByIdSet($collocazione->current()->idPosizione);

            $this->_stanza = $posizioni->current()->stanza;
            $this->_numPiano = $posizioni->current()->numPiano;
            $this->_edificio = $posizioni->current()->edificio;
        }
        else{

            $this->getHelper('Redirector')->gotoSimple('checkin','livello1',$module=null);
            }


    }

    public function init()
    {    
        $this->_authService = new Application_Service_Auth();
        $this->_helper->layout->setLayout('layout1');
        $this->user=$this->_authService->getAuth()->getIdentity()->current()->username;
        $this->modificaform= $this->getModificaform();
        $this->view->modificaform= $this->modificaform;
        $this->livello=$this->_authService->getAuth()->getIdentity()->current()->livello;

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

        $numPiano=$this->controllaParam('numPiano');
        $edificio=$this->controllaParam('edificio');
        $stanza=$this->controllaParam('elencostanze');

        $this->reinderizzaErroreAction($stanza, $edificio, $numPiano,'checkinb');

        $idposizione=new Application_Model_Posizioni();
        $posizioni=$idposizione->getIdPosizioniByNumPianoStanzaEdificioSet($numPiano, $stanza,$edificio);

        $collocazionemodel=new Application_Model_Collocazioni();
        $collocazione=$collocazionemodel->getCollocazioneByUserSet($this->user);


        if($collocazione->current()===null )
        {
            $collocazionemodel->insertCollocazioni($this->user,$posizioni->current()->id );
        }
        else
        {
            $collocazionemodel->updateCollocazioni($posizioni->current()->id,$this->user);
        }

        $this->getHelper('Redirector')->gotoSimple('index','livello1', $module = null);

    }

    public function inseriscidatisegnalazioneAction()
    {

        $numPiano=$this->controllaParam('numPiano');
        $edificio=$this->controllaParam('edificio');
        $evento=$this->controllaParam('evento');
        $stanzasegnalata=$this->controllaParam('segnalastanza');

        $collocazionemodel=new Application_Model_Collocazioni();
        $collocazione=$collocazionemodel->getCollocazioneByUserSet($this->user);

        $posizionemodel=new Application_Model_Posizioni();
        $posizioni=$posizionemodel->getPosizioniByIdSet($collocazione->current()->idPosizione);

        $stanza=$posizioni->current()->stanza;

        $this->reinderizzaErroreAction($stanzasegnalata, $edificio, $numPiano, 'caricamappasegnalazione');

        $idPosizione = $posizionemodel->getIdPosizioniByNumPianoStanzaEdificioSet($numPiano,$stanzasegnalata,$edificio);

        $segnalazionemodel = new Application_Model_Segnalazioni();
        $segnalazionemodel->insertSegnalazioni($this->user, $idPosizione->current()->id, $evento);

        $this->getHelper('Redirector')->gotoSimple('index','livello1', $module = null, array('edificio'=>$edificio,
            'numPiano'=>$numPiano,
            'stanza'=>$stanza));

    }

    public function controllaeventoAction(){
        
        $eventomodel=new Application_Model_Eventi();
        $evento=$eventomodel->getEventi();
        if($evento->current()==array())
            return false;

        $pianomodel=new Application_Model_Piani();
        $piano=$pianomodel->getPianiById($evento->current()->idPiano);

        if($this->_edificio==$piano->current()->edificio && $this->_numPiano==$piano->current()->numeroPiano){
            return true;
        }
        return false;
    }
    public function indexAction()
    {

        $this->controlladatiAction();
        $evacuare=$this->controllaeventoAction();
        $this->view->evacuare=$evacuare;
        $this->view->arrayInformazioni = array('stanza'=>$this->_stanza,'numPiano'=>$this->_numPiano,'edificio'=>$this->_edificio);

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

        if(is_null($edificio))
            $this->getHelper('Redirector')->gotoSimple('error','error',$module=null);



        $edificimodel = new Application_Model_Edifici();
        $controllaedificio = $edificimodel->getEdificio($edificio);

        if($controllaedificio->current()==0)
            $this->getHelper('Redirector')->gotoSimple('error','error',$module=null);



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

        $pianimodel=new Application_Model_Piani();
        $piani = $pianimodel->getPianiByEdificio($edificio);
        $controllo=array();
        foreach ($piani as $p){
        $controllo[]=$p->numeroPiano;
           }
        if(is_null($edificio))
            $this->getHelper('Redirector')->gotoSimple('error','error',$module=null);

        if(!in_array($numPiano, $controllo))
            $this->getHelper('Redirector')->gotoSimple('error','error',$module=null);

        if ($numPiano==0)
            $this->getHelper('Redirector')->gotoSimple('checkinint','livello1',$module=null,array('edificio'=>$edificio));
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
        $idPosizione=$idPosizionemodel->getCollocazioneByUserSet($this->user);

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


        $collocazionemodel=new Application_Model_Collocazioni();
        $collocazione=$collocazionemodel->getCollocazioneByUserSet($this->user);

        $posizionemodel=new Application_Model_Posizioni();
        $posizioni=$posizionemodel->getPosizioniByIdSet($collocazione->current()->idPosizione);

        $assegnazionemodel=new Application_Model_Assegnazione();
        $assegnazione=$assegnazionemodel->getAssegnazioneByZonaSet($posizioni->current()->zona);


        $pianoDiFugamodel=new Application_Model_PianoDiFuga();
        
        $pianoDiFuga=$pianoDiFugamodel->getPianoDiFugaByIdSet($assegnazione->current()->idPianoFuga);

        $this->view->pianta=$pianoDiFuga->current()->pianta;
        

    }

    public function modificadatiutenteAction()
    {
        
    }


  public function getModificaform()
  {
      return $this->getHelper('ModificaProfilo')->getForm($this->user, 1);
  }

    public function verificamodificaAction()
        {
            $request = $this->getRequest();

            $form = $this->modificaform;

            $this->getHelper('ModificaProfilo')->verificaModifica($request,1,$form);
        }


    public function cancellaposizioneAction(){
        $collocazionemodel=new Application_Model_Collocazioni();
        $collocazione=$collocazionemodel->deletecollocazione($this->user);
        $this->getHelper('Redirector')->gotoSimple('index','livello1', $module = null);

    }

}



















