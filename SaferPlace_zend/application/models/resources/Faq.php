<?php


class Application_Resource_Faq extends Zend_Db_Table_Abstract

{

    /*
     * Informazioni sulla tabella
     */
    protected $_name = 'faq';
    protected $_primary ='id';
    protected $_rowClass = 'Application_Resource_Faq_Item';

    //seleziono tutte le tuple della tabella
    public function getAll(){
        $select = $this->select();
        return $this->fetchAll($select);
    }


}

