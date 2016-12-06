<?php

class App_Controller_Plugin_Acl extends Zend_Controller_Plugin_Abstract
{
    protected $_acl;
    protected $_role;
    protected $_auth;

    public function __construct()
    {
        $this->_auth = Zend_Auth::getInstance();
        
        //se non c'è nessun ruolo nella sessione lo settiamo a zero altrimenti gli assegnamo quello dell'utente che ha fatto il login
        $this->_role = !$this->_auth->hasIdentity() ? '0' : $this->_auth->getIdentity()->current()->livello;
        
        $this->_acl = new Application_Model_Acl();
    }

    
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        
        //controllo che l'utente abbia il permesso ad accedere a determinate zone del programma
        if (!$this->_acl->isAllowed($this->_role, $request->getControllerName())) {
            $this->_auth->clearIdentity();
            $this->denyAccess(); //rimanda all'index
        }
    }

    public function denyAccess()
    {
        
        $this->_request->setModuleName('default')
                    ->setControllerName('index')
                    ->setActionName('index');
    }
}
