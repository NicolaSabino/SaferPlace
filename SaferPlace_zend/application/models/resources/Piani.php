<?php
class Application_Resource_Piani extends  Zend_Db_Table_Abstract
{
    protected  $_name='piano';

    public function getPianiByEdificio($edificio){

        $select=$this->select()
            ->where('edificio= ? ',$edificio);
        return $this->fetchAll($select);

    }

    public function getPianta($edificio, $numeropiano){

        $select = $this
            ->select()
            ->setIntegrityCheck(false)
            ->from('piano', 'pianta' )
            ->where('numeroPiano = ?', $numeropiano)
            ->where('edificio = ?', $edificio);
        return $this->fetchAll($select);

    }
}

