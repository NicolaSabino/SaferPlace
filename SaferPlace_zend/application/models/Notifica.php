<!-- tutto questo codice andrà distribuito in un model riguardante lo staff, forse anche altri model, per ora lo lascio così
perchè devo testare -->
<?php
class Application_Model_Notifica extends App_Model_Abstract{


    protected $_name = 'segnalazione';

    //@return array di array assiociativi contenente tutte le notifiche relative a un edificio
    public function fetchAllByEd($edificio)
    {
        return $this->getResource('Notifica')->getAllByEd($edificio);
    }

    //cancella una notifica
    public function delete($id) {
    
        $this->getResource('Notifica')->deleteOne($id);

    }
    //cancella tutte le notifiche relative a un edificio
    public function delAllByEd($edificio)
    {
        $this->getResource('Notifica')->deleteAllByEd($edificio);
    }
    //recupera edificio e piano di una notifica
    public function getEdPi($id){
        return $this->getResource('Notifica')->getEdificioPiano($id);
    }

}
