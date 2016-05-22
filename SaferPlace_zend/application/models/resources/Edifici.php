<?php

class Application_Model_Edifici extends  Zend_Db_Table_Abstract
{
    protected  $_name='edificio';
    protected $_rowClass='Application_Model_DbTable_Edifici';

    public function getEdifici(){

        $select=new Application_Model_DbTable_Edifici();
        $select=$this->select();
        return $this->fetchAll($select);

    }

}
