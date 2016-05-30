<?php

class App_Controller_Plugin_Acl extends Zend_Controller_Plugin_Abstract
{
    protected $_acl;
    protected $_livello;
    protected $_auth;

    public function __construct()
    {
        $this->_auth = Zend_Auth::getInstance();

        $this->_livello = !$this->_auth->hasIdentity() ? '0' : $this->_auth->getIdentity()[0]['livello'];
        $this->_acl = new Application_Model_Acl();
    }

    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        if (!$this->_acl->isAllowed($this->_livello, $request->getControllerName())) {
            $this->_auth->clearIdentity();
            $this->denyAccess();
        }
    }

    public function denyAccess()
    {
        $this->_request->setModuleName('default')
            ->setControllerName('index')
            ->setActionName('index');
    }
}
