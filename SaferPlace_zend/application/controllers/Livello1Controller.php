<?php

class Livello1Controller extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $user="Peppep94";
        $zona=$this->controllaParam('zona');
        $stanza=$this->controllaParam('stanza');
        $idPiano=$this->controllaParam('idPiano');
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

    }
    public function checkinAction()
    {
        $edificimodel=new Application_Resource_Edifici();
        $this->view->u = $edificimodel->getEdifici()->toArray();
    }

    public function checkinbAction()
    {
        $pianimodel=new Application_Resource_Piani();
        $edificio=$this->controllaParam('edificio');
        $edificimodel=new Application_Resource_Edifici();
        $this->view->v = $edificimodel->getEdifici($edificio)->toArray();
        $this->view->u = $pianimodel->getPianiByEdificio($edificio)->toArray();
    }

    public function controllaParam($param)
    {
        $parametro=0;
        if($this->hasParam("$param"))
            $parametro=$this->getParam("$param");
        return $parametro;
    }


}









