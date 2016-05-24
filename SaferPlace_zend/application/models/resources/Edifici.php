<?php

class Application_Resource_Edifici extends  Zend_Db_Table_Abstract
{
    protected  $_name='edificio';

    /**
     * seleziona tutti gli edifici dal db
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function getEdifici(){

        $select=$this->select();
        return $this->fetchAll($select);

    }

    /**
     * genero un insieme di edifici che sono gestiti dalla medesima persona
     * @param $nomeUtente
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function getGestByUtente($nomeUtente){

        $select = $this->select()->setIntegrityCheck(false)->from('gestione')->where('utente = ?', $nomeUtente);

        return $this->fetchAll($select);

    }
}
