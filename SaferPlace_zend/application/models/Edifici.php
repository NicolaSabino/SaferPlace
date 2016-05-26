<?php

class Application_Model_Edifici extends App_Model_Abstract
{
    
    

    public  function getEdificiSet()
    {
        return $this->getResource('Edifici')->getAll();
    }

}
