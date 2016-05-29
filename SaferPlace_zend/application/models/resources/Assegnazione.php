<?php
class Application_Resource_Assegnazione extends  Zend_Db_Table_Abstract
{
    protected  $_name='assegnazione';
    protected $_rowClass='Application_Resource_Assegnazione_Item';


    public function getAssegnazioniByZona($zona){

        $select=$this->select()
            ->where('zona= ? ',$zona)
            ->where('abilitato=1');
        return $this->fetchAll($select);

    }


}