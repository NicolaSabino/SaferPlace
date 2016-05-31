<?php
class Application_Resource_Piani extends  Zend_Db_Table_Abstract
{
    protected  $_name='piano';
   // protected  $_identity = 

    /**
     * restituisce l'elenco dei piani dell'edificio passato per parametro
     * @param $edificio
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function getPianiByEdificio($edificio){

        $select=$this->select()
            ->where('edificio= ? ',$edificio);
        return $this->fetchAll($select);

    }

    /**
     * restituisce la pianta in base all'edificio e al piano
     * @param $edificio
     * @param $numeropiano
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function getPianta($edificio, $numeropiano){

        $select = $this
            ->select()
            ->setIntegrityCheck(false)
            ->from('piano', 'pianta' )
            ->where('numeroPiano = ?', $numeropiano)
            ->where('edificio = ?', $edificio);
        return $this->fetchAll($select);

    }

    /**
     * restitusice il numero delle stanze di un piano di un edificio
     * @param $edificio
     * @param $numPiano
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function getNStanzeByPiano($edificio, $numPiano){
        $select=$this->select()
            ->where('edificio= ? ',$edificio)
            ->where('numeroPiano= ? ',$numPiano);
        return $this->fetchAll($select);
    }
}

