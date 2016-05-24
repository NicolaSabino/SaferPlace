<?php
class Application_Resource_Utenza extends  Zend_Db_Table_Abstract
{
    protected  $_name='utente';
    protected $_rowClass='Application_Resource_Utenza_Item';
    //protected $_sequence = true;

    public function getAll(){

        $select = $this->select();
        return $this->fetchAll($select);

    }
    

}
