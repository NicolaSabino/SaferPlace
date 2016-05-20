<?php
class Application_Model_Piani extends  Zend_Db_Table_Abstract
{
    protected  $_name='piano';
    protected $_rowClass='Application_Model_DbTable_Piani';

    public function getPianiByEdificio($edificio){

        $select=new Application_Model_DbTable_Edifici();
        $select=$this->select()
            ->where('edificio= ?',$edificio);
        return $this->fetchAll($select);

    }

}

