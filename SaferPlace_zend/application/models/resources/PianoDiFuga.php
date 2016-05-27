<?php
class Application_Resource_PianoDiFuga extends  Zend_Db_Table_Abstract
{
    protected  $_name='pianodifuga';
    protected $_rowClass='Application_Resource_PianoDiFuga_Item';


    public function getPianiDiFugaByid($id){

        $select=$this->select()
            ->where('id= ? ',$id);
        return $this->fetchAll($select);

    }


}