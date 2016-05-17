<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{


    protected function _initSetupBaseUrl() {
    $this->bootstrap('frontcontroller');
    $controller = Zend_Controller_Front::getInstance();
    $controller->setBaseUrl('/SaferPlace/SaferPlace_zend/public');
}

    protected function _initRequest()
        // Aggiunge un'istanza di Zend_Controller_Request_Http nel Front_Controller
        // che permette di utilizzare l'helper baseUrl() nel Bootstrap.php
        // Necessario solo se la Document-root di Apache non è la cartella public/
        //necessaria per far girare più di un progetto su una macchina server
    {
        $this->bootstrap('FrontController');
        $front = $this->getResource('FrontController');
        $request = new Zend_Controller_Request_Http();
        $front->setRequest($request);
    }



}




