<?php
class Application_Resource_Posizioni extends  Zend_Db_Table_Abstract
{
    protected  $_name='posizione';
    protected $_rowClass='Application_Resource_Piani_Item';
    protected $_sequence = true;

    public function getIdPosizioniBynumPianoStanza($numPiano,$stanza){

        $select=new Application_Resource_Piani_Item();
        $select=$this->select('id')
                     ->where('numPiano='.$numPiano.' and stanza='. $stanza);
        return  $this->fetchAll($select);

    }
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

