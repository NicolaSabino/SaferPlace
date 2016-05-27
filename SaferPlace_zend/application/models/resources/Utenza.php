<?php
class Application_Resource_Utenza extends  Zend_Db_Table_Abstract
{
    protected  $_name='utente';
    protected $_rowClass='Application_Resource_Utenza_Item';
    //protected $_sequence = true;

    public function getAll(){

        $select = $this->select();
        return $this->fetchAll($select);

    }

    public function insertUser($param){

        $this->insert($param);
    }

    public function setUtente($elem){
        

        // se l'utente ha inserito una nuova password procedo ad aggiornare tutti i campi
        if($elem['password']!=""){

            $data = array(
                'nome'      =>  $elem['nome'],
                'cognome'   =>  $elem['cognome'],
                'genere'    =>  $elem['genere'],
                'eta'       =>  $elem['eta'],
                'telefono'  =>  $elem['telefono'],
                'username'  =>  $elem['username'],
                'password'  =>  $elem['password'],
                'email'     =>  $elem['email']
            );

        }else {

            // altrimenti aggiorno tutti i campi ad eccezione della password*/
            $data = array(
                'nome' => $elem['nome'],
                'cognome' => $elem['cognome'],
                'genere' => $elem['genere'],
                'eta' => $elem['eta'],
                'telefono' => $elem['telefono'],
                'username' => $elem['username'],
                'password' => $elem['password'],
                'email' => $elem['email']
            );
        }

        // la chiave che ci permettere di aggiornare la tupla nel db è l'username dell'utente prelevato prima delle modifiche
        $where = $this->getAdapter()->quoteInto('username = ?', $elem['old']);

        //$where = 'username = ' . $elem['oldname'];

        //$this->getAdapter()->update('utente',$data,$where);

        $this->update($data, $where);

    }

}
