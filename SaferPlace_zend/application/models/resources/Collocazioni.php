<?php
class Application_Resource_Collocazioni extends  Zend_Db_Table_Abstract
{
    protected  $_name='collocazione';
    protected $_rowClass='Application_Resource_Collocazioni_Item';

    public function getCollocazioniByUser($user){

        $select=new Application_Resource_Piani_Item();
        $select=$this->select()
                     ->where('utente=?',$user);
        return $this->fetchAll($select);

    }
    
    public function insertCollocazione($user,$posizione)
    {
        $collocazioni = array(
            'utente'      => $user,
            'idPosizione' => $posizione,
        );

        $this->insert($collocazioni);
    }

    public function updateCollocazione($idPosizione,$user)
    {
        $data = array(
            'idPosizione'      => $idPosizione,
        );
        $where = $this->getAdapter()->quoteInto('utente = ?', $user);

        $this->update($data, $where);
    }

}

