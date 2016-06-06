<?php
class Application_Model_Piani extends  App_Model_Abstract
{

    
    public function getPianiByEdificio($edificio){

        return $this->getResource('Piani')->getPianiByEdificio($edificio);
        
    }


    public  function getPianiSet(){

        return $this->getResource('Piani')->getAll();

    }
    
    public function getNStanzeByPianoSet($edificio,$piano){
        return $this->getResource('Piani')->getNstanzebyPiano($edificio,$piano);
    }
    
    public function nuovoPiano($value){
        $this->getResource('Piani')->nuovoPiano($value);
    }
    
    public function getId($edificio,$piano){
        return $this->getResource('Piani')->getIdPiano($edificio,$piano);
    }
    
    public function getPianoById($id){
        return $this->getResource('Piani')->getPiano($id);
    }

}

