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
       /*
        $select = this->select()
        //devo vedere come recuperare roba da un join
                                ->where('edificio')
        return $this->;
       */
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
