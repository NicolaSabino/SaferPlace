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
                     ->from(array('a'=>'assegnazione'), array())
                     ->setIntegrityCheck(false)
                     ->join(array('z'=> 'zona'),'a.zona=z.id', array('edificio', 'piano'))
                     ->join(array('pdf'=>'pianodifuga'),'pdf.id=a.idPianoFuga')
                     ->where('z.id= ? ',$zona);
        
        return $select;
    }

    public function disabilitaPianoFuga($zona) {

        $this->update(array('abilitato'=> 0), 'abilitato = 1 AND zona = '.$zona);
        
    }

    public function abilitaPianoFuga($id){

        $this->update(array('abilitato'=> 1), 'idPianoFuga = '.$id);
    }

    public function delAssegnazioneByZona($zona) {

        $del = $this->getAdapter()->quoteInto('zona = ?', $zona);
        $this->delete($del);
    }

    //recupero le occorrenze di assegnazione in base all'id di un piano di fuga
    public function getAssegnazioneByPdf($idPdf){
        
        $select = $this->select()
                       ->from('assegnazione')
                       ->where('idPianoFuga = ?', $idPdf);
        
        return $this->fetchAll($select);
    }

    public function delByPdf($idpdf) {

        $where = $this->getAdapter()->quoteInto('idPianoFuga = ?', $idpdf);
        $this->delete($where);
    }
    
}