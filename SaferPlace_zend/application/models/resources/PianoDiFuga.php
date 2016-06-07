<?php
class Application_Resource_PianoDiFuga extends  Zend_Db_Table_Abstract
{
    protected  $_name='pianodifuga';
    protected $_rowClass='Application_Resource_PianoDiFuga_Item';


    public function getPianiDiFugaByid($id){

        $select=$this->select()
            ->where('id=?',$id);
        return $this->fetchAll($select);

    }

    public function getPianiDiFugaByZona($zona){
        
        $select= $this->select()
                      ->from(array('pdf'=>'pianodifuga'))
                      ->join(array('a'=>'assegnazione'), 'a.zona=pdf.zona', 'abilitato')
                      ->where('zona = ?', $zona);

        return $select;
    }

    public function delById($id){

        $del =$this->getAdapter()->quoteInto('id = ?', $id);
        
        $this->delete($del);
    }


    public function getPDF_edificio_piano($edificio,$piano){

        //stringa che serve a selezionare tutte le piante che sono del tipo EDIFICIO_PIANO_%
        $app = $edificio . " Piano " . $piano . "%";

        $select = $this->select()
            ->where (' pianta like ?', $app);

        return $this->fetchAll($select);
    }
    
    public function newPdf($nomeFile){
        
        $data = array( 'pianta' => $nomeFile);
        
        $this->insert($data);
    }

    public function getByPianta($nomepianta){
        
        $select = $this->select()
                       ->from('pianodifuga', 'id')
                       ->where('pianta like ?', $nomepianta.'%');
        return $this->fetchAll($select);
    }
    
    public function delByNome($nomepianta){

        
        $where = $this->getAdapter()->quoteInto('pianta like ?', $nomepianta.'%');
        $this->delete($where);

    }
}