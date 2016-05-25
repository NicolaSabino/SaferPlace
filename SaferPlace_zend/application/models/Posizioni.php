<?php

class Application_Model_Posizioni extends App_Model_Abstract
{
    public  function getPosizioniSet()
    {
        return $this->getResource('Posizioni')->getAll();
    }

    public function getIdPosizioniByNumPianoStanzaSet($numPiano, $stanza){
        return $this->getResource('Posizioni')->getIdPosizioniBynumPianoStanza($numPiano, $stanza);
    }

    public function getPosizioniByIdSet($id){
        return $this->getResource('Posizioni')->getPosizioniById($id);
    }
}