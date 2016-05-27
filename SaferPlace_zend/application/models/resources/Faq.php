<?php


class Application_Resource_Faq extends Zend_Db_Table_Abstract

{

    /*
     * Informazioni sulla tabella
     */
    protected $_name = 'faq';
    protected $_primary ='id';
    protected $_rowClass = 'Application_Resource_Faq_Item';


    /**
     * seleziono tutte le faq della tabella del db
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function getAll(){
        $select = $this->select();
        return $this->fetchAll($select);
    }


    /**
     * Metodo per aggiornare una tupla di faq
     * @param $domanda
     * @param $risposta
     * @param $id
     */
    public function setFaq($domanda,$risposta,$id){

        
        $data = array(
            'domanda' => $domanda,
            'risposta' => $risposta
        );

        $where = "id = $id";

        $this->getAdapter()->update('faq',$data,$where);
       
    }

    public function insertFaq($domanda,$risposta){

        $info = array(
            'domanda' => $domanda,
            'risposta' => $risposta
        );

        $this->insert($info);

    }

    public function delFaq($id){

        $where = $this->getAdapter()->quoteInto('id = ?',$id);

        $this->delete($where);
    }


}

