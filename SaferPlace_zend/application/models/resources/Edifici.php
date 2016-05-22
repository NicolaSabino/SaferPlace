<?php

class Application_Model_Edifici extends  Zend_Db_Table_Abstract
{
    protected  $_name='edificio';
    //protected $_rowClass='Application_Resource_Edifici_Item';

    public function getEdifici(){

        $select=$this->select();
        return $this->fetchAll($select);

    }

}
