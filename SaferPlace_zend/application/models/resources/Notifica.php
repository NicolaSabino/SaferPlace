<?php

class Application_Resource_Notifica extends Zend_Db_Table_Abstract {
    
   protected $_name = 'segnalazione';

    //recupera le notifiche riguardanti un edificio
public function getAllByEd($edificio) {
    //notifiche è un oggetto Zend_Db_Select che rappresenta una query
    //this->getAdapter() è un metodo di Zend_Db_Adapter che ti fa recuperare l'adattatore standard per la connessione
    //al db
    $select = $this
        ->select()
        ->setIntegrityCheck(false)
        ->from(array('s'=>'segnalazione'),array('id','utente','tipo'))
        ->join(array('pos'=> 'posizione'),
            'pos.id = s.idPosizione', array('numPiano','edificio','stanza'))
        ->where('pos.edificio = ?', $edificio);
    //eseguo la query notifiche e metto il risultato in una variabile
//restituisco solo la query perchè mi serve in una funzione che recupera tutte le notifiche di un membro staff
    return $select;
    }


    //cancella una notifica passando l'id della stessa
    public function deleteOne($id) {
        $where = $this->getAdapter()->quoteInto('id = ?', $id);
        $done = $this->delete($where);

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
            ->join(array('p'=>'piano'), 'pos.numPiano=p.id', array('edificio','numeroPiano'))
            ->where('s.id = ?', $id);

        return $this->fetchAll($select);
    }
}