<?php
class Application_Resource_Utenti extends  Zend_Db_Table_Abstract
{
    protected  $_name='utente';
    protected $_rowClass='Application_Resource_Utenti_Item';


    public function insertUtente($dati){
        $this->insert($dati);
    }

    /**
     * controlla che un username passato per parametro esista già nel db
     * se esiste ritorna vero, altrimenti ritorna falso
     * @param $username
     * @return bool
     */
    public function existsUsername($username)
    {
        $select=new Application_Resource_Utenti_Item();
        $select=$this->select()
            ->where('username=?',$username);

        $risultato = $this->getAdapter()->query($select);

        if($risultato->rowCount()==0)
            $controllo = false;
        else $controllo = true;
        return $controllo;
    }


    /**
     * controlla che all'username inserito è associata la password inserita
     * se è giusta ritorna vero, altrimenti falso
     * @param $username
     * @param $password
     * @return bool
     */
    public function isRightPassword($username,$password){
        $select=new Application_Resource_Utenti_Item();
        $select=$this->select()
            ->where('username=?',$username)
            ->where('password=?',$password);

        $risultato = $this->getAdapter()->query($select);

        if($risultato->rowCount()==0)
            $controllo = false;
        else $controllo = true;
        return $controllo;
    }

    /**
     * seleziona i dati dell'utente passato per parametro
     * @param $user
     * @return mixed
     */
    public function getDatiUtenteByUser($user)
    {

        $select=$this->select()
            ->where('username= ? ',$user);
        
        return $this->fetchAll($select);
    }


    /**
     * effettua l'update di un utente
     * @param $dati
     */
    public function updateUtenti($dati, $username)
    {
        $data = array(
            'username'      => $dati['username'],
            'nome'      => $dati['Nome'],
            'cognome'      => $dati['Cognome'],
            'password'      => $dati['password'],
            'genere'      => $dati['genere'],
            'eta'      => $dati['eta'],
            'email'      => $dati['email'],
            'telefono'      => $dati['telefono'],
        );
        $where = $this->getAdapter()->quoteInto('username = ?', $username);

        $this->update($data, $where);
    }

    /**
     * effettua l'update di un utente da parte dell'admin, gestisce anche l'update del livello dell'utente
     * @param $dati
     */
    public function updateUtentiAdmin($dati, $username)
    {
        $data = array(
            'username'      => $dati['username'],
            'nome'      => $dati['Nome'],
            'cognome'      => $dati['Cognome'],
            'password'      => $dati['password'],
            'genere'      => $dati['genere'],
            'eta'      => $dati['eta'],
            'email'      => $dati['email'],
            'telefono'      => $dati['telefono'],
            'livello'       => $dati['lilvello'],
        );
        $where = $this->getAdapter()->quoteInto('username = ?', $username);

        $this->update($data, $where);
    }

}