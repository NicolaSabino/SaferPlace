<?php

class Application_Model_Piani extends App_Model_Abstract
{
    public  function getPianiSet()
    {
        return $this->getResource('Piani')->getAll();
    }
}