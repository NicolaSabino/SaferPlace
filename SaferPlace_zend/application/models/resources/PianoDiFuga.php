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
}