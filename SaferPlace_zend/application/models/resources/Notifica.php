<?php

class Application_Resource_Notifica extends Zend_Db_Table_Abstract {
    
   protected $_name = 'segnalazione';

    //recupera le notifiche riguardanti un edificio
public function getAllByEd($edificio) {

    //devo definire qui un adattatore db per usare il db intero
    $dbAdapter = Zend_Db::factory('PDO_mysql', array(
        'host'     => 'localhost',
        'username' => 'root',
        'password' => '',
        'dbname'   => 'sp_db'
    ));

    // TODO finire a scrivere la query
    //notifiche è un oggetto Zend_Db_Select che rappresenta una query
    $notifiche = $dbAdapter->select()
        ->from(array('s'=>'segnalazione'),array('id','utente','idPosizione','tipo'))
        ->join(array('pos'=> 'posizione'),
            'pos.id = s.idPosizione', array());

    //eseguo la query notifiche e metto il risultato in una variabile
    $stamp=$dbAdapter->query($notifiche);
    
    return $stamp->fetchAll();
    }


    //cancella una notifica passando l'id della stessa
    public function deleteOne($id) {

        $where = $this->getAdapter()->quoteInto('id = ?', $id);
        $this->delete($where);


    }
    //cancella tutte le notifiche relative a un edificio
    public function deleteAllByEd($edificio)
    {
        //adattatore
        $dbAdapter = Zend_Db::factory('PDO_mysql', array(
            'host'     => 'localhost',
            'username' => 'root',
            'password' => '',
            'dbname'   => 'sp_db'
        ));


    }
    //recupera edificio e piano di una notifica
    public function getEdificioPiano($id){

    }
}