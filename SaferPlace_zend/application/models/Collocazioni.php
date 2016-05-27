<?php

class Application_Model_Collocazioni extends App_Model_Abstract
{
    public  function getCollocazioniSet()
    {
        return $this->getResource('Collocazioni')->getAll();
    }
    
    public function getCollocazioneByUserSet($user){
        return $this->getResource('Collocazioni')->getCollocazioniByUser($user);
    }

    public function insertCollocazioni($user,$posizione){
        return $this->getResource('Collocazioni')->insertCollocazione($user,$posizione);
    }
    
    public function updateCollocazioni($idPosizione, $user){
        return $this-->$this->getResource('Collocazioni')->updateCollocazione($idPosizione,$user);
    }
}