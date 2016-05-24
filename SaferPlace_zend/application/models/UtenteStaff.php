<?php

class Application_Model_UtenteStaff extends App_Model_Abstract
{
    protected $_nomeUtente;

    // TODO dobbiamo definire come passargli il nome utente
    public function __construct(){
        $this->_nomeUtente='nicolanabbo';
    }
    
    //restituisce l'insieme degli edifici gestiti da un determinato utente
    public function getEdificiGestiti(){
        
       
        $pianiModel             = new Application_Model_Piani();
        $edifici_e_piani        = array();

        //estraggo gli edifici
        $arrayEdifici = $this->getResource('Edifici')->getGestByUtente($this->_nomeUtente);


        //creo un array di array associativi per contenere linsieme di edifici e i relativi piani
        foreach ($arrayEdifici as $edificio) {

            //salvo il nome dell'edificio considerato
            $nomeEdificio = $edificio->edificio;

            //estraggo i piani dell'edificio considerato
            $piani = $pianiModel->getPianiByEdificio($nomeEdificio);

            //per ogni piano ne salvo il nome
            foreach ($piani as $item) {

                $var = $item->numeroPiano;
                //creo il vettore multidimensionale contenente il risultato
                $edifici_e_piani[$nomeEdificio][] = $var;

            }
        }
        return $edifici_e_piani;
        
    }

    public function getNotificheEmergenze(){

        $ed= new Application_Resource_Edifici();
        $edificigest = $ed->getGestByUtente($this->_nomeUtente);
        $notifica = new Application_Resource_Notifica();


        foreach ($edificigest as $item) {
            $queryArray[] = $notifica->getAllByEd($item->edificio);

        }
        // crea la query union per avere tutte le notifiche di tutti gli edifici gestiti in un unico rowset
        $allnotif = $notifica->select()->union($queryArray);
       /*     print_r($notifica->fetchAll($notifica->select()->union($queryArray)));
        die;*/
        return $notifica->fetchAll($allnotif);
    }

    public function getPlanimetria($edificio,$numeropiano){

        $pianta = new Application_Resource_Piani();

        return $pianta->getPianta($edificio, $numeropiano);
    }
}