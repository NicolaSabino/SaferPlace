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

    public function insertPosizione($zona,$stanza,$numPiano, $edificio){
        return $this->getResource('Posizioni')->insertPosizione($zona,$stanza,$numPiano, $edificio);
    }
    
    public function getPosizioniBynumPianoEdificio($numPiano,$edificio){
        return $this->getResource('Posizioni')->getPosizioniBynumPianoEdificio($numPiano,$edificio);
    }
    
    public function existsPosizione($numPiano,$stanza,$edificio){
        return $this->getResource('Posizioni')->existsPosizione($numPiano,$stanza,$edificio);
    }

}