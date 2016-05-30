<?php
class Application_Resource_Assegnazione extends  Zend_Db_Table_Abstract
{
    protected  $_name='assegnazione';
    protected $_rowClass='Application_Resource_Assegnazione_Item';


    public function getAssegnazioniByZona($zona){

        $select=$this->select()
            ->where('zona= ? ',$zona)
            ->where('abilitato=1');
        return $this->fetchAll($select);

    }

    public function getAssegnazioniByZonaStaff($zona){

        $select=$this->select()
                     ->from(array('a'=>'assegnazione'))
                     ->join(array('z'=> 'zona'),'a.zona=z.id')
                     ->join(array('pdf'=>'pianodifuga'),'pdf.id=a.idPianoFuga')
                     ->where('zona= ? ',$zona);

        return $this->fetchAll($select);
    }


}