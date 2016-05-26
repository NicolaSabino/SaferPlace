<?php

class Application_Model_Eventi extends App_Model_Abstract {
    
    public function addEvento($nome,$idSegnalazione, $idpiano) {

      return $this->getResource('Eventi')->addEvento($nome,$idSegnalazione,$idpiano);
    }

    public function delEvento($id) {

        return $this->getResource('Eventi')->delEvento($id);
    }

   


}
