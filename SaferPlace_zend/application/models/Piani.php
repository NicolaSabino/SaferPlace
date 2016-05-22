<?php
class Application_Model_Piani extends  Zend_Db_Table_Abstract
{
    protected  $_name='piano';

    public function getPianiByEdificio($edificio){

        
        $select=$this->select()
            ->where('edificio= ?',$edificio);
        return $this->fetchAll($select);

    }

}

