<?php

class Application_Model_Posizioni extends App_Model_Abstract
{
    public  function getPosizioniSet()
    {
        return $this->getResource('Posizioni')->getAll();
    }
}