<?php


class Application_Resource_Faq extends Zend_Db_Table_Abstract

{

    /*
     * Informazioni sulla tabella
     */
    protected $_name = 'faq';
    protected $_primary ='id';
    protected $_rowClass = 'Application_Resource_Faq_Item';


    /**
     * seleziono tutte le faq della tabella del db
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function getAll(){
        $select = $this->select();
        return $this->fetchAll($select);
    }


}

