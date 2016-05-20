<?php

/*
 *  Mapper delle FAQ
 */

class Application_Model_Faq extends App_Model_Abstract
{

    /*
<<<<<<< HEAD
     * Restituisce un oggetto rappresentante il set di Faq presenti nel db
=======
     * Restituisce un oggetto rappresentante il set di faq presenti nel db
>>>>>>> defd2dda133fc8aeebf98bd9c3d2f5df116b558e
     *
     * @return Zend_Db_Table_Abstract
     */
    public function getFaqSet(){

        return $this->getResource('Faq')->getAll();

    }

}

