<?php

class Application_Model_Segnalazioni extends App_Model_Abstract
{
    
    public function insertSegnalazioni($user,$idPosizione, $tipo){
        return $this->getResource('Segnalazioni')->insertSegnalazione($user,$idPosizione, $tipo);
    }

}