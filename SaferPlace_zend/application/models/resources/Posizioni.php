<?php
class Application_Resource_Posizioni extends  Zend_Db_Table_Abstract
{
    protected  $_name='posizione';
    protected $_rowClass='Application_Resource_Piani_Item';
    protected $_sequence = true;

    /**
     * dati il numero del piano e la stanza restituisce l'id della posizione dell'utente
     * @param $numPiano
     * @param $stanza
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function getIdPosizioniBynumPianoStanza($numPiano,$stanza){

        $select=new Application_Resource_Piani_Item();
        $select=$this->select('id')
                     ->where('numPiano='.$numPiano.' and stanza='. $stanza);
        return  $this->fetchAll($select);

    }

    public function getPosizioniById($id){

        $select=new Application_Resource_Piani_Item();
        $select=$this->select()
            ->where('id=?',$id);
        return  $this->fetchAll($select);

    }

    /**
     * inserisce nel db la posizione dell'utente
     * @param $zona
     * @param $stanza
     * @param $numPiano
     */
    public function insertPosizione($zona,$stanza,$numPiano)
    {
        $posizioni = array(
            'zona'      => $zona,
            'stanza' => $stanza,
            'numPiano'      => $numPiano
        );

        $this->insert($posizioni);
    }

}

