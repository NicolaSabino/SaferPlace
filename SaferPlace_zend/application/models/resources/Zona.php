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
    
    
    
}