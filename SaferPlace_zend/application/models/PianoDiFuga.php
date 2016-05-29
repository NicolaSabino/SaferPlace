<?php
class Application_Model_PianoDiFuga extends  App_Model_Abstract
{


    public function getPianoDiFugaByIdSet($id){

        return $this->getResource('PianoDiFuga')->getPianiDiFugaByid($id);

    }
    


}

