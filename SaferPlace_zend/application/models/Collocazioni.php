<?php

class Application_Model_Collocazioni extends App_Model_Abstract
{
    public  function getCollocazioniSet()
    {
        return $this->getResource('Collocazioni')->getAll();
    }
}