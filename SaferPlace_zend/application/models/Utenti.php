<?php

class Application_Model_Utenti extends App_Model_Abstract
{

    public function insertUtenti($dati){
        return $this->getResource('Utenti')->insertUtente($dati);
    }
    
    public function existUsername($username){
        return $this->getResource('Utenti')->existsUsername($username);
    }
}