<?php
class Model_Notifica extends Zend_Db_Table_Abstract{


    protected $_name = 'segnalazione';


    public function getAllByEd($edificio)
    {
        //recupero tutte le notifiche relative a un edificio
        $select = $this->select()
                        ->from ('segnalazione','posizione','piano')
                        ->where ("segnalazione.idPosizione=posizione.id AND piano.id=posizione.idPiano AND edificio='$edificio'")
                        ->columns('segnalazione.utente','piano.edificio');


        return $select;

    }

    //cancella una notifica
    public function deleteOne() {


    }
    //cancella tutte le notifiche relative a un edificio
    public function deleteAllByEd($edificio)
    {

    }
    //recupera edificio e piano di una notifica
    public function getEdificioPiano($id){

    }

}
