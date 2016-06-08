<?php

class Application_Model_Admin extends App_Model_Abstract
{

    //elimina tutte le zone di un piano e i dati a esse relative, prendendo in input nome edificio  e numero piano
    public function eliminaZonePiano($edificio, $piano)
    {


        $zone = $this->getResource('Zona')->getZoneByEdPiano($edificio, $piano);

        foreach ($zone as $item) {
            $this->eliminaZona($item)->id;
        }

    }


    public function eliminaZona($id)
    {

        $assegnazioneResource = new Application_Resource_Assegnazione();

        $pianiFuga = $this->getResource('Assegnazione')->getAssegnazioniByZona($id);
        $assegnazioneResource->delAssegnazioneByZona($id);

        foreach ($pianiFuga as $item) {

            if (count
                ($this->getResource('Assegnazione')->getAssegnazioneByPdf($item->idPianoFuga)) == 0
            ) {

                $this->getResource('PianoDiFuga')->delById($item->idPianoFuga);
            }
        }
        $this->getResource('Posizioni')->delByZona($id);
        $this->getResource('Zona')->delById($id);

    }

    public function eliminaPiano($edificio, $piano)
    {

        $this->eliminaZonePiano($edificio, $piano);
        $this->getResource('Piani')->delByEdPiano($edificio, $piano);

    }

    public function eliminaEdificio($edificio)
    {


        $piani = $this->getResource('Piani')->getPianiByEdificio($edificio);

        foreach ($piani as $item) {

            $this->eliminaPiano($edificio, $item->numeroPiano);
        }

        $this->getResource('Edifici')->delByName($edificio);
    }

    public function eliminaPianoFugaByNome($nomepianta)
    {

        $var = $this->getResource('PianoDiFuga')->getByPianta($nomepianta);
        //print_r($id); die();
        $this->getResource('PianoDiFuga')->delByNome($nomepianta);
        $this->getResource('Assegnazione')->delByPdf($var->id);

    }

    public function getIdZona($edificio, $piano, $alias)
    {
        return $this->getResource('Zona')->getIdZona($edificio, $piano, $alias);
    }

    public function getZonabyId($id)
    {
        return $this->getResource('Zona')->getZonabyId($id);

    }

    public function getZoneByEdPianoIdasAlias($edificio, $numPiano)
    {
        return $this->getResource('Zona')->getZoneByEdPianoIdasAlias($edificio, $numPiano);
    }

    public function existsZone($edificio, $piano)
    {        
        return $this->getResource('Zona')->existsZone($edificio, $piano);
    }
    
    public function insertZona($dati){
        return $this->getResource('Zona')->insertZona($dati);
    }

    public function updateZoneByEdificio($edificio,$data){
        return $this->getResource('Zona')->updateZoneByEdificio($data,$edificio);
    }
}