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
    
    public function nuovoPiano($value){
        $this->getResource('Piani')->nuovoPiano($value);
    }
    
    public function getId($edificio,$piano){
        return $this->getResource('Piani')->getIdPiano($edificio,$piano);
    }
    
    public function getPiano($edificio, $piano){
        return $this->getResource('Piani')->getPiano($edificio,$piano);
    }

    public function updatePiano($data,$id){
        return $this->getResource('Piani')->updatePiano($data,$id);
    }

    public function updatePianiByPianta($pianta,$data){
        return $this->getResource('Piani')->updatePianiByPianta($pianta,$data);
    }    

}

