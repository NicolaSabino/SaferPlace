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

    //restituisce una query che calcola il numero di persone presenti nell'edificio fornito
    public function  getNumCollocazioniByEdificio($edificio) {

        $select = $this->select()
                       ->setIntegrityCheck(false)
                       ->from(array('c' => 'collocazione'), array())
                       ->join (array('pos' => 'posizione'), 'c.idPosizione=pos.id', array())
                       ->join (array('p' => 'piano'), 'pos.numPiano=p.numeroPiano AND p.edificio=pos.edificio',
                                array('numPersone' => 'COUNT(*)'))
                       ->where ('p.edificio = ?', $edificio);
        return $select;

    }

    //restituisce un rowset con il numero di persone presenti nel piano specificato
    public function getNumByPiano($edificio, $piano) {

        $bypiano = $this->getNumCollocazioniByEdificio($edificio)->where('p.numeroPiano = ?', $piano);

        return $this->fetchAll($bypiano)->current();

    }

    public function getNumPerStanza($edificio,$piano){

        $select =$this->select()
                      ->setIntegrityCheck(false)
                      ->from(array('c' => 'collocazione'), array('personeStanza' => 'COUNT(*)'))
                      ->join(array('pos' => 'posizione'), 'c.idPosizione=pos.id','stanza')
                      ->where('pos.edificio = ?', $edificio)
                      ->where('pos.numPiano = ?', $piano)
                      ->order('pos.stanza')
                      ->group('pos.id');
        return $this->fetchAll($select);
    }

    public function deletecollocazione($username){
        $row = $this->fetchRow($this->select()->where('utente = ?', $username));
        $row->delete();
    }
}

