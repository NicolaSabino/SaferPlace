<?php

class Application_Model_UtenteStaff extends App_Model_Abstract
{
    protected $_nomeUtente;

    // TODO dobbiamo definire come passargli il nome utente
    public function __construct(){
        $this->_nomeUtente='nicolanabbo';
    }
    
    //restituisce l'insieme degli edifici gestiti da un determinato utente
    public function getEdificiGestiti($nomeUtente){
        
       
        $pianiModel              = new Application_Model_Piani();
        $edifici_e_piani        = array();

        //estraggo gli edifici
        $arrayEdifici = $this->getResource('Edifici')->getGestByUtente($nomeUtente);


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
            $notifArray[] = $notifica->getAllByEd($item->edificio);
            print_r($notifica->getAllByEd($item->edificio));
        }

        return $notifArray;
    }
}