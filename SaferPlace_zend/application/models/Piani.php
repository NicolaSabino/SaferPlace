<?php
class Application_Model_Piani extends  App_Model_Abstract
{
    //protected  $_name='piano';
    //protected $_rowClass='Application_Model_DbTable_Piani';


    public function getPianiByEdificio($edificio){

        return $this->getResource('Piani')->getPianiByEdificio($edificio);
        
    }


    public  function getPianiSet(){

        return $this->getResource('Piani')->getAll();

    }

}

