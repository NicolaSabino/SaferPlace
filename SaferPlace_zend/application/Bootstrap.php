<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initDoctype()
    {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('XHTML1_STRICT');
        
    }
    protected function _initSetupBaseUrl() {
        $this->bootstrap('frontcontroller');
        $controller = Zend_Controller_Front::getInstance();
        $controller->setBaseUrl('/SaferPlace/SaferPlace_zend/public');
    }
}

