<?php

class Livello1Controller extends Zend_Controller_Action
{
    protected  $stanzaform;
    public function init()
    {
        $this->_helper->layout->setLayout('layout1');
        
    }

    public function indexAction()
    {
        
        $user="Peppep94";
        $zona=$this->controllaParam('zona');
        $numPiano=$this->controllaParam('numPiano');
        $edificio=$this->controllaParam('edificio');
        $stanza=$this->controllaParam('elencostanze');
        $idposizione=new Application_Resource_Posizioni();
        $posizioni=$idposizione->getIdPosizioniBynumPianoStanza($numPiano, $stanza)->toArray();
        $collocazionemodel=new Application_Resource_Collocazioni();
        $collocazione=$collocazionemodel->getCollocazioniByUser($user)->toArray();
        if($collocazione===array() )
        {
            $collocazionemodel->insertCollocazione($user,$posizioni[0]['id'] );
        }
        else
        {
            $collocazionemodel->updateCollocazione($posizioni[0]['id'], $user);
        }
        $this->view->u=array('stanza'=>$stanza,'numPiano'=>$numPiano,'edificio'=>$edificio);

    }

    public function checkinAction()
    {
        $edificimodel=new Application_Resource_Edifici();
        $this->view->u = $edificimodel->getEdifici()->toArray();
    }

    public function checkinbAction()
    {
        $edificio=$this->controllaParam('edificio');
        $numPiano=$this->controllaParam('numPiano');
        $_stanzeModel=new Application_Resource_Piani();
        $numStanze = $_stanzeModel->getNStanzeByPiano($edificio, $numPiano)->toArray();
        $numStanze = $numStanze[0]['nstanze'];
        $this->stanzaform= new Application_Form_Selezionastanza($numStanze);
        $this->view->v = array('edificio'=>$edificio, 'numPiano'=>$numPiano);
        $this->stanzaform->setAction($this->view->url(
            array(
                'controller' => 'livello1',
                'action' => 'index',
            )
        ));
        $this->view->formstanza=$this->stanzaform;
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
        //$pianoform= new Application_Form_Selezionapiano();
        $pianimodel=new Application_Resource_Piani();
        $edificio=$this->controllaParam('edificio');
        $edificimodel=new Application_Resource_Edifici();
        $this->view->v = $edificimodel->getEdifici($edificio)->toArray();
        $this->view->u = $pianimodel->getPianiByEdificio($edificio)->toArray();
        //$this->view->formpiano=$pianoform;
    }


}











