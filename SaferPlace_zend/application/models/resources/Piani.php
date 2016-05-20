<?php
class Application_Resource_Piani extends  Zend_Db_Table_Abstract
{
    protected  $_name='piano';
    protected $_rowClass='Application_Resource_Piani_Item';

    public function getPianiByEdificio($edificio){

        $select=new Application_Resource_Piani_Item();
        $select=$this->select()
            ->where('edificio= ?',$edificio);
        return $this->fetchAll($select);

    }

}

