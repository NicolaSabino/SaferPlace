<?php

class Zend_View_Helper_AuthInfo extends Zend_View_Helper_Abstract
{
    protected $_authService;

    public function authInfo ($info = null)
    {
        if (null === $this->_authService) {
            $this->_authService = new Application_Service_Auth();
        }
        if (null === $info) {
            return;
        }
        if (false === $this->isLoggedIn()) {
            return;
        }
        return $this->_authService->getIdentity()->current()->$info;
    }

    public function isLoggedIn()
    {
        return $this->_authService->getAuth()->hasIdentity();
    }
}
