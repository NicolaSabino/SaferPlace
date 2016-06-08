<?php

class Application_Resource_Zona extends Zend_Db_Table_Abstract {
    
    protected $_name= 'zona';
    
    public function getZoneByEdPiano($edificio,$piano) {
    
        $select = $this->select()
                       ->setIntegrityCheck(false)
                       ->from (array('z'=>'zona'))
                       ->where('z.edificio = ?', $edificio)
                       ->where('z.piano = ?', $piano);
    
        return $this->fetchAll($select);
    
    }
    
    public function delById($id){

        $del =$this->getAdapter()->quoteInto('id = ?', $id);

        $this->delete($del);
    }
    
    public function getZone(){
        
        $select = $this->select()
                       ->from('zona', 'id');
        
        return $this->fetchAll($select);
    }
    
    public function getZonabyId($id){
        $select = $this->select()
            ->where('id = ?', $id);

        return $this->fetchAll($select);
    }
    
    public function getIdZona($edificio, $piano, $alias){
        
        $select = $this->select()
            ->where('edificio = ?', $edificio)
            ->where('piano = ?', $piano)
            ->where('alias = ?', $alias);
        
        return $this->fetchAll($select);
    }

    /**
     * true se esiste altrimenti false
     * @param $edificio
     * @param $piano
     * @return bool
     */
    public function existsZone($edificio, $piano){

        $select=$this->select()
            ->where('edificio=?',$edificio)
            ->where('piano=?',$piano);

        $risultato = $this->getAdapter()->query($select);

        if($risultato->rowCount()==0)
            $controllo = false;
        else $controllo = true;
        return $controllo;
    }
    

    public function getZoneByEdPianoIdasAlias($edificio, $numPiano){
        $select = $this->select()
                        ->setIntegrityCheck(false)
                        ->from(array('p' => 'posizione' ), array('edificio', 'numPiano','stanza'))
                        ->join(array('z' => 'zona'), 'p.zona = z.id', array('alias'))
                        ->where('p.edificio = ?', $edificio)
                        ->where('p.numPiano = ?', $numPiano);
        return $this->fetchAll($select);

    }

    public function insertZona($dati){
        $this->insert($dati);
    }
    
    
    
}