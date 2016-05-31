<?php
class Application_Resource_Gestione extends  Zend_Db_Table_Abstract
{
    protected $_name = 'gestione';

    public function assign($edificio,$username){

        $info = array(
            'edificio' => $edificio,
            'utente' => $username
        );

        $this->insert($info);
    }
    
    public function getAll(){
        $select = $this->select();
        return $this->fetchAll($select);
    }

    public function elimina($edificio){

        $where = $this->getAdapter()->quoteInto('edificio = ?', $edificio);
       
        $this->delete($where);
    }

    public function eliminaByUtente($utente){
        
        $where = $this->getAdapter()->quoteInto('utente = ?', $utente);
        
        $this->delete($where);
    }

}