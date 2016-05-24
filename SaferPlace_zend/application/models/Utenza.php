<?php
class Application_Model_Utenza extends App_Model_Abstract
{
public  function getUtenza(){
    
return $this->getResource('Utenza')->getAll();
    
}
}