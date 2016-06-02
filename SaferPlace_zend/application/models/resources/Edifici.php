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


    /**
     * @return Zend_Db_Statement_Interface
     */
    public function getEdificiNonGestiti(){

        $edifici = $this
            ->select()
            ->setIntegrityCheck(false)
            ->from(array('e'=>'edificio'))
            ->joinLeft(array('g'=> 'gestione'),
                'e.nome = g.edificio')
            ->where('g.utente is null');
        //eseguo la query notifiche e metto il risultato in una variabile

        return $this->fetchAll($edifici);
    }

    public function getByName($nome){

        $edificio = $this->select()->where('nome = ?',$nome);
        return $this->fetchAll($edificio);
    }

    public function delByName($nome){

        $where = $this->getAdapter()->quoteInto('nome = ?',$nome);

        $this->delete($where);
    }

    public function updateByName($data,$key){

        if($data['mappa'] == null){
            $data = array(
                'nome'          => $data['nome'],
                'informazioni'  => $data['informazioni']
            );
        }

        $where = $this->getAdapter()->quoteInto('nome = ?',$key);

        $this->update($data,$where);


    }


}
