<?php

class Application_Model_UtenteStaff extends App_Model_Abstract
{
    
    //restituisce l'insieme degli edifici gestiti da un determinato utente
    public function getEdificiGestiti($nomeUtente){
        
        return $this->getResource('Edifici')->getByUtente($nomeUtente);
        
    }
}