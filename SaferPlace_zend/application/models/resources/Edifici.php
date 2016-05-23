<?php

class Application_Resource_Edifici extends  Zend_Db_Table_Abstract
{
    protected  $_name='edificio';
    //protected $_rowClass='Application_Resource_Edifici_Item';

    public function getEdifici(){

        $select=$this->select();
        return $this->fetchAll($select);

    }

    //genero un insieme di edifici che sono gestiti dalla medesima persona
    public function getByUtente($nomeUtente){

        $select = $this->getAdapter()->select()->from('gestione')->where('utente = ?', $nomeUtente);
        $appoggio = $this->getAdapter()->query($select);
        return $appoggio->fetchAll();

    }
}
