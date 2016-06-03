<?php

class Application_Model_Edifici extends App_Model_Abstract
{

    public function getEdificiSet()
    {
        return $this->getResource('Edifici')->getEdifici();
    }

    public function getGestioni(){
        return $this->getResource('Gestione')->getAll();
    }

    public function assegna($edificio,$username){
        $this->getResource('Gestione')->assign($edificio,$username);
    }

    public function nonAssegnati(){

        return $this->getResource('Edifici')->getEdificiNonGestiti();
    }

    public function eliminaAssegnazione($edificio){
        $this->getResource('Gestione')->elimina($edificio);
    }

    public function eliminaAssegnazioneByUtente($utente){
        $this->getResource('Gestione')->eliminaByUtente($utente);
    }

    public function getEdificio($nome){
        return $this->getResource('Edifici')->getByName($nome);
    }

    public function deleteEdifico($nome){
        $this->getResource('Edifici')->delByName($nome);
    }

    public function updateEdificio($param,$key){
        $this->getResource('Edifici')->updateByName($param,$key);
    }
    
}
