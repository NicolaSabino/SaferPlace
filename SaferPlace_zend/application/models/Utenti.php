<?php

class Application_Model_Utenti extends App_Model_Abstract
{

    public function insertUtenti($dati){
        return $this->getResource('Utenti')->insertUtente($dati);
    }
    
    public function existUsername($username){
        return $this->getResource('Utenti')->existsUsername($username);
    }

    public function isRightPassword($username,$password){
        return $this->getResource('Utenti')->isRightPassword($username,$password);
    }

    public function getDatiUtenteByUserSet($username){
        return $this->getResource('Utenti')->getDatiUtenteByUser($username);
    }

    public function updateUtentiSet($dati, $username){
        return $this->getResource('Utenti')->updateUtenti($dati, $username);
    }
    
    public function updateUtentiAdmin($dati, $username){
        return $this->getResource('Utenti')->updateUtentiAdmin($dati, $username);
    }

    
}