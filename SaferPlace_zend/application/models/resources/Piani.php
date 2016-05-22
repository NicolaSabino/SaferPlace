<?php


class Application_Resource_Piani extends Zend_Db_Table_Abstract
{

    /*
     * Informazioni sulla tabella
     */
    protected $_name = 'faq';
    protected $_primary ='id';

    //seleziono tutte le tuple della tabella
    public function getAll(){
        $select = $this->select();
        return $this->fetchAll($select);
    }

    //seleziono tutti i piani collegati ad un determinato edificio
    public function getByEdificio($nomeEdificio){
        $select = $this->select()->where('edificio = '. $nomeEdificio);
        return $this->fetchAll($select);
    }


}