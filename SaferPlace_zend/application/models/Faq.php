<?php

/*
 *  Mapper delle FAQ
 */

class Application_Model_Faq extends App_Model_Abstract
{

    /*
     * Restituisce un oggetto rappresentante il set di Faq presenti nel db
     *
     * @return Zend_Db_Table_Abstract
     */
    public function getFaqSet(){

        return $this->getResource('Faq')->getAll();

    }

}

