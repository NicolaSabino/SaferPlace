<?php
class notifica extends Zend_Db_Table_Abstract{


    protected $_name = 'segnalazione';
    protected $_id;
    protected $_user;
    protected $_tipo;
    protected $_edificio;
    protected $_piano;
    protected $_zona;

    public function getAllByEd($edificio)
    {
        //recupero tutte le notifiche relative a un edificio
        $select = this->select('s.*')
                                ->from('segnalazione s JOIN posizione pos ON 
                                        s.idPosizione=pos.id JOIN piano p
                                         ON pos.idPiano=p.id')
                                ->where('p.edificio=$edificio');
        return $this->$select;

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
