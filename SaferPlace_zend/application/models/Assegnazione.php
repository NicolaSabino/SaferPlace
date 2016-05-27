<?php
class Application_Model_Assegnazione extends  App_Model_Abstract
{


    public function getAssegnazioneByZonaSet($id){

        return $this->getResource('Assegnazione')->getAssegnazioniByZona($id);

    }



}

