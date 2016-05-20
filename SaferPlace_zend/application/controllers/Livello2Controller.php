<?php

class Livello2Controller extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function notifyAction()
    {
        //devo definire qui un adattatore db per usare il db intero
        $dbAdapter = Zend_Db::factory('PDO_mysql', array(
            'host'     => 'localhost',
            'username' => 'root',
            'password' => '',
            'dbname'   => 'sp_db'
        ));
        //notifiche è un oggetto Zend_Db_Select che rappresenta una query
        //nel mio caso ho provato un join, la sintassi tocca vedersela sulla documentazione
        $notifiche = $dbAdapter->select()
                                ->from(array('s'=>'segnalazione'),array('id','utente','idPosizione','tipo'))
                                ->join(array('pos'=> 'posizione'),
                                        'pos.id = s.idPosizione', array());
        //eseguo la query notifiche e metto il risultato in una variabile
        $stamp=$dbAdapter->query($notifiche);
        //estraggo i risultati dell'esecuzione della query e li stampo
        print_r($stamp->fetchAll());
        die;
        //$this->view->assign('notifiche',$notifiche->fetchAll());

    }


}



