<?php
class Application_Model_Utenza extends App_Model_Abstract
{
    
    public  function getUtenza(){
        
    return $this->getResource('Utenza')->getAll();
        
    }
    
    public function nuovoUtente($parametri){
        $this->getResource('Utenza')->insertUser($parametri);
    }
    
    public function modificaUtente($elem){
        

        $this->getResource('Utenza')->setUtente($elem);
    }
    
}