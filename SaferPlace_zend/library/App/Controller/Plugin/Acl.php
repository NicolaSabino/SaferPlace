<?php

class App_Controller_Plugin_Acl extends Zend_Controller_Plugin_Abstract
{
    protected $_acl;
<<<<<<< HEAD
    protected $_role;
=======
    protected $_livello;
>>>>>>> origin/Giù
    protected $_auth;

    public function __construct()
    {
        $this->_auth = Zend_Auth::getInstance();
<<<<<<< HEAD
        $this->_role = !$this->_auth->hasIdentity() ? '0' : $this->_auth->getIdentity()[0]['role'];
=======

        $this->_livello = !$this->_auth->hasIdentity() ? '0' : $this->_auth->getIdentity()[0]['livello'];
>>>>>>> origin/Giù
        $this->_acl = new Application_Model_Acl();
    }

    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
<<<<<<< HEAD
        if (!$this->_acl->isAllowed($this->_role, $request->getControllerName())) {
=======
        if (!$this->_acl->isAllowed($this->_livello, $request->getControllerName())) {
>>>>>>> origin/Giù
            $this->_auth->clearIdentity();
            $this->denyAccess();
        }
    }

    public function denyAccess()
    {
        $this->_request->setModuleName('default')
<<<<<<< HEAD
                    ->setControllerName('index')
                    ->setActionName('index');
=======
            ->setControllerName('index')
            ->setActionName('index');
>>>>>>> origin/Giù
    }
}
