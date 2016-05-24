<?php

class Application_Model_Edifici extends App_Model_Abstract
{
    protected  $_name='edificio';

 
    public  function  getEdificiSet()
    {
        return $this->getResource('Edifici')->getEdifici();
    }

}
