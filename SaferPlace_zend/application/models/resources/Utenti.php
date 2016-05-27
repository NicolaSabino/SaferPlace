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

}