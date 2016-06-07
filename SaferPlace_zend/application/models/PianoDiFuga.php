<?php
class Application_Model_PianoDiFuga extends  App_Model_Abstract
{


    public function getPianoDiFugaByIdSet($id){

        return $this->getResource('PianoDiFuga')->getPianiDiFugaByid($id);

    }
    
    public function getByEdificioPiano($edificio,$piano){
        return $this->getResource('PianoDiFuga')->getPDF_edificio_piano($edificio,$piano);
    }
    

    public function newPiano($data){
        $this->getResource('PianoDiFuga')->newPdf($data);
    }

}

