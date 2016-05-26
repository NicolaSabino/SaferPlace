<?php

class Application_Model_Utenti extends App_Model_Abstract
{

    public function insertUtenti($nome, $cognome,$telefono,$email,$username,$password,$genere,$eta){
        return $this->getResource('Utenti')->insertUtente($nome, $cognome,$telefono,$email,$username,$password,$genere,$eta);
    }

}