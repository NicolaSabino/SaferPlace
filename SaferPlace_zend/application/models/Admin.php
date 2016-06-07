<?php

class Application_Model_Admin extends App_Model_Abstract {

    //elimina tutte le zone di un piano e i dati a esse relative, prendendo in input nome edificio  e numero piano
    public function eliminaZonePiano($edificio,$piano){


        $zone = $this->getResource('Zona')->getZoneByEdPiano($edificio,$piano);

        foreach ($zone as $item){
            $this->eliminaZona($item)->id;
        }

    }


    public function eliminaZona ($id) {

        $assegnazioneResource = new Application_Resource_Assegnazione();

        $pianiFuga = $this->getResource('Assegnazione')->getAssegnazioniByZona($id);
        $assegnazioneResource->delAssegnazioneByZona($id);

        foreach ($pianiFuga as $item){

            if (count
                ($this->getResource('Assegnazione')->getAssegnazioneByPdf($item->idPianoFuga)) == 0){

                $this->getResource('PianoDiFuga')->delById($item->idPianoFuga);
            }
        }
        $this->getResource('Posizioni')->delByZona($id);
        $this->getResource('Zona')->delById($id);

    }

    public function getIdZona($edificio, $piano, $alias){
        return $this->getResource('Zona')->getIdZona($edificio, $piano, $alias);
    }
    
    public function getZonabyId($id){
        return $this->getResource('Zona')->getZonabyId($id);

    }
    
    public function getZoneByEdPianoIdasAlias($edificio, $numPiano){
        return $this->getResource('Zona')->getZoneByEdPianoIdasAlias($edificio, $numPiano);
    }
}