<?php
class Application_Resource_Utenti extends  Zend_Db_Table_Abstract
{
    protected  $_name='utente';
    protected $_rowClass='Application_Resource_Utenti_Item';


    public function insertUtente($nome, $cognome,$telefono,$email,$username,$password,$genere,$eta){

        $utenti = array(
            'nome'      => $nome,
            'cognome' => $cognome,
            'telefono' => $telefono,
            'email' => $email,
            'username' => $username,
            'password' => $password,
            'genere' => $genere,
            'eta' => $eta,
        );

        $this->insert($utenti);

    }

}