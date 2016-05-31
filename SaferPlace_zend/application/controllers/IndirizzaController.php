<?php

class IndirizzaController extends Zend_Controller_Action

{
    protected $_authService;

    public function init()
    {
        $this->_authService = new Application_Service_Auth();
    }
    public function indexAction()
    {
        $array=$this->_authService->getIdentity()->toArray();
        $ruolo= $array[0]['livello'];
        if ($ruolo == '1')
            $this->_helper->redirector('index', 'livello1');
        if ($ruolo == '2')
            $this->_helper->redirector('index', 'livello2');
        if ($ruolo == '3')
            $this->_helper->redirector('index', 'livello3');

        $this->_helper->redirector('index', 'index');
    }
    public function logoutAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
        $this->_helper->redirector('index', 'index');
    }


}

