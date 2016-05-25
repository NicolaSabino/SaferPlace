<?php

/*
 *  Mapper delle FAQ
 */

class Application_Model_Faq extends App_Model_Abstract
{
    
    public function getFaqSet(){
        return $this->getResource('Faq')->getAll();

    }
}

    