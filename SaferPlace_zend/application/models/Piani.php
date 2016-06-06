<?php
class Application_Model_Piani extends  App_Model_Abstract
{

    
    public function getPianiByEdificio($edificio){

        return $this->getResource('Piani')->getPianiByEdificio($edificio);
        
    }


    public  function getPianiSet(){

        return $this->getResource('Piani')->getAll();

    }

    public  function getPianiById($id){

        return $this->getResource('Piani')->getPianiById($id);

    }
    
    public function getNStanzeByPianoSet($edificio,$piano){
        return $this->getResource('Piani')->getNstanzebyPiano($edificio,$piano);
    }
    
    

}

