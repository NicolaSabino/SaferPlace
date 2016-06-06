<?php
class Application_Model_Utenza extends App_Model_Abstract
{
    
    public  function getUtenza(){
        
    return $this->getResource('Utenza')->getAll();
        
    }
    
    public function nuovoUtente($parametri){
        $this->getResource('Utenza')->insertUser($parametri);
    }
    
    public function modificaUtente($elem,$key){
        

        $this->getResource('Utenza')->setUtente($elem,$key);
    }

    public function deleteUtente($username){
        
        $this->getResource('Utenza')->delUser($username);
    }
    
    public function getUsers(){
        return $this->getResource('Utenza')->getUsers();
    }
    
}