<?php

class Livello1Controller extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->layout->setLayout('layout1');
    }

    public function indexAction()
    {
        $user="Peppep94";
        $zona=$this->controllaParam('zona');
        $stanza=$this->controllaParam('stanza');
        $idPiano=$this->controllaParam('idPiano');
        $edificio=$this->controllaParam('edificio');
        $idposizione=new Application_Resource_Posizioni();
        $posizioni=$idposizione->getIdPosizioniByidPianoStanza($idPiano, $stanza)->toArray();
        $collocazionemodel=new Application_Resource_Collocazioni();
        $collocazione=$collocazionemodel->getCollocazioniByUser($user)->toArray();
        if($collocazione[0]['utente']==$user)
        {    
            $collocazionemodel->updateCollocazione($posizioni[0]['id'], $user);
          
        }
        else
        {
            $collocazionemodel->insertCollocazione($user,$posizioni[0]['id'] );
        }

       // print_r();
        $this->view->u=array('stanza'=>$stanza,'idPiano'=>$idPiano,'edificio'=>$edificio);

    }

    public function checkinAction()
    {
        $edificimodel=new Application_Resource_Edifici();
        $this->view->u = $edificimodel->getEdifici()->toArray();
    }

    public function checkinbAction()
    {
        $pianoform= new Application_Form_Selezionapiano();
        $stanzaform = new Application_Form_Selezionastanza();
        $pianimodel=new Application_Resource_Piani();
        $edificio=$this->controllaParam('edificio');
        $edificimodel=new Application_Resource_Edifici();
        $this->view->v = $edificimodel->getEdifici($edificio)->toArray();
        $this->view->u = $pianimodel->getPianiByEdificio($edificio)->toArray();
        $this->view->formstanza=$stanzaform;
        $this->view->formpiano=$pianoform;
    }

    public function controllaParam($param)
    {
        $parametro=0;
        if($this->hasParam("$param"))
            $parametro=$this->getParam("$param");
        return $parametro;
    }

    public function checkinintAction()
    {
        $pianoform= new Application_Form_Selezionapiano();
        $pianimodel=new Application_Resource_Piani();
        $edificio=$this->controllaParam('edificio');
        $edificimodel=new Application_Resource_Edifici();
        $this->view->v = $edificimodel->getEdifici($edificio)->toArray();
        $this->view->u = $pianimodel->getPianiByEdificio($edificio)->toArray();
        $this->view->formpiano=$pianoform;
    }


}











