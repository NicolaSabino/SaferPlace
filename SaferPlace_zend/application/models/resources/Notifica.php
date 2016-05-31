<?php

class Application_Resource_Notifica extends Zend_Db_Table_Abstract {
    
   protected $_name = 'segnalazione';

    //recupera le notifiche riguardanti un edificio
public function getAllByEd($edificio) {
    //$select rappresenta la query che voglio eseguire
    $select = $this
        ->select()
        ->setIntegrityCheck(false)
        ->from(array('s'=>'segnalazione'),array('id','utente','tipo'))
        ->join(array('pos'=> 'posizione'),
            'pos.id = s.idPosizione', array('posizione' => 'id','numPiano' => 'numPiano','edificio' => 'edificio','stanza' =>'stanza'))
        ->where('pos.edificio = ?', $edificio);
    
    //restituisco la query senza eseguirla perchè mi serve in una funzione che recupera tutte le notifiche di un edificio gestito
    //da un membro staff e le inserisce in una union
    return $select;
    }


    //cancella una notifica passando l'id della stessa
    public function deleteOne($id) {
        $where = $this->getAdapter()->quoteInto('id = ?', $id);
        $done = (bool) $this->delete($where);

        return $done;
    }
    
    //cancella tutte le notifiche relative a un edificio
    public function deleteAllByEd($edificio)
    {
        $select = "delete s FROM segnalazione s JOIN posizione pos ON pos.id=s.idPosizione JOIN piano p 
                  ON p.id=pos.numPiano WHERE p.edificio='$edificio'";
        
        $done = (bool) $this->getAdapter()->query($select);
        
        return $done;
    }
    
    //recupera edificio e piano di una notifica
    public function getEdificioPiano($id){

            $select = $this
            ->select()
            ->setIntegrityCheck(false)
            ->from(array('s'=>'segnalazione'),array())
            ->join(array('pos'=> 'posizione'),
                'pos.id = s.idPosizione', array())
            ->join(array('p'=>'piano'), 'pos.numPiano=p.numeroPiano AND pos.edificio=p.edificio', array('edificio','numeroPiano'))
            ->where('s.id = ?', $id);

        return $this->fetchAll($select);
    }
}