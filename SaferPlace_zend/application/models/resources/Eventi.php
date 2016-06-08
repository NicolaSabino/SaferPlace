<?php
class Application_Resource_Eventi extends Zend_Db_Table_Abstract {

    protected  $_name = 'evento';
    protected $_rowClass = 'Application_Resource_Faq_Item';


    public function addEvento($nome,$idSegnalazione, $idpiano, $zona)
    {
        $data= array ('id'=> null,'nome'=>$nome,'idSegnalazione'=>$idSegnalazione, 'idPiano'=> $idpiano, 'zona' =>$zona);
        
        return (bool) $this->insert($data);
    }

    public function deleteOne($id) {

        $where = $this->getAdapter()->quoteInto('id = ?', $id);
        $done = (bool) $this->delete($where);

        return $done;
    }

    public function getAllByEd($edificio) {

        $select = $this
            ->select()
            ->setIntegrityCheck(false)
            ->from(array('e'=>'evento'),array('id','nome','idPiano'))
            ->join(array('p'=> 'piano'),
                'e.idPiano = p.id', array('numeroPiano','edificio'))
            ->where('p.edificio = ?', $edificio);
            

        //restituisco solo la query perchè mi serve in una funzione che fa una union
        return $select;
    }
    

}