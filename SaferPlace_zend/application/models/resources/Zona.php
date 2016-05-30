<?php

class Application_Rescource_Zona extends Zend_Db_Table_Abstract {
    
    protected $_name= 'zona';
    
    public function getZoneByEdPiano($edificio,$piano) {
    
        $select = $this->select()
                       ->from (array('z'=>'zona'), 'id')
                       ->join (array('pos'=>'posizione'), 'pos.zona=z.id', array('edificio', 'numPiano'))
                       ->where('p.edificio = ?', $edificio)
                       ->where('p.numPiano = ?', $piano);
    
        return $this->fetchAll($select);
    
    }
    
    
    
}