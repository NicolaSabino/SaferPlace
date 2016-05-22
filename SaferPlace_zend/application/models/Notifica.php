<?php
class Application_Model_Notifica extends App_Model_Abstract{


    protected $_name = 'segnalazione';

    //@return array di array assiociativi contenente tutte le notifiche relative a un edificio
    public function fetchAllByEd($edificio)
    {
        return $this->getResource('Notifica')->getAllBEd($edificio);
    }

    //cancella una notifica
    public function delete($id) {
    
        $this->getResource('Notifica')->deleteOne($id);

    }
    //cancella tutte le notifiche relative a un edificio
    public function deleteAllByEd($edificio)
    {

    }
    //recupera edificio e piano di una notifica
    public function getEdificioPiano($id){

    }

}
