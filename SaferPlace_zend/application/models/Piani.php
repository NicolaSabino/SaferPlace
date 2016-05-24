<?php
class Application_Model_Piani extends  App_Model_Abstract
{
    protected  $_name='piano';
    //protected $_rowClass='Application_Model_DbTable_Piani';

    public function getPianiByEdificio($edificio){
        
        $select=$this->select()
            ->where('edificio=?',$edificio);
        return $this->fetchAll($select);

    }
        public  function getPianiSet()
        {
        return $this->getResource('Piani')->getAll();
        }

}

