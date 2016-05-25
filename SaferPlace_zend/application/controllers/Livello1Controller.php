<?php

class Livello1Controller extends Zend_Controller_Action
{

    protected $stanzaform = null;

    public function init()
    {
        $this->_helper->layout->setLayout('layout1');
    }

    public function inseriscidatiposizioneAction($stanza,$edificio,$numPiano,$user)
    {

        //controlla che la stanza sia stata scelta dalla select, se non viene scelta si ricarica la pagina
        if($stanza==0) {
            $action = 'checkinb';
            $controller = 'livello1';
            $params = array('edificio'=>$edificio,
                'numPiano'=>$numPiano,
                'errore'=>'errore'); //aggiunge all'url un parametro "errore" che permetterà di visualizzare un messaggio di errore

            $this->getHelper('Redirector')->gotoSimple($action, $controller, $module = null, $params);
        }



        $idposizione=new Application_Model_Posizioni();
        $posizioni=$idposizione->getIdPosizioniByNumPianoStanzaSet($numPiano, $stanza);

        $collocazionemodel=new Application_Model_Collocazioni();
        $collocazione=$collocazionemodel->getCollocazioneByUserSet($user);

        if($collocazione===array() )
        {
            $collocazionemodel->insertCollocazioni($user,$posizioni[0]['id'] );
        }
        else
        {
            $collocazionemodel->updateCollocazioni($posizioni[0]['id'], $user);
        }
    }

    public function indexAction()
    {

        $user="Peppep94";
        $numPiano=$this->controllaParam('numPiano');
        $edificio=$this->controllaParam('edificio');
        $stanza=0;
        $this->controllaParam('segnalastanza');
        $evento=$this->controllaParam('evento');
        if($evento===0) {
            $stanza = $this->controllaParam('elencostanze');
            $this->inseriscidatiposizioneAction($stanza, $edificio, $numPiano, $user);
        }
        else
        {
            $collocazionemodel=new Application_Model_Collocazioni();
            $collocazione=$collocazionemodel->getCollocazioneByUserSet($user);
            $posizionemodel=new Application_Model_Posizioni();
            $posizioni=$posizionemodel->getPosizioniByIdSet($collocazione->current()->idPosizione);
            $stanza=$posizioni->current()->stanza;
            
        }
        


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
                'action' => 'index',
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
                'action' => 'index',
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



}















