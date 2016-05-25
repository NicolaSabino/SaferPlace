<?php

class Application_Model_Posizioni extends App_Model_Abstract
{
    public  function getPosizioniSet()
    {
        return $this->getResource('Posizioni')->getAll();
    }

    public function getIdPosizioniByNumPianoStanzaEdificioSet($numPiano, $stanza,$edificio){
        return $this->getResource('Posizioni')->getIdPosizioniBynumPianoStanzaEdificio($numPiano, $stanza,$edificio);
    }

    public function getPosizioniByIdSet($id){
        return $this->getResource('Posizioni')->getPosizioniById($id);
    }
}