<?php

class Application_Service_Auth
{
<<<<<<< HEAD
    protected $_utentimodel;
=======
    protected $userModel;
>>>>>>> origin/Giù
    protected $_auth;

    public function __construct()
    {
<<<<<<< HEAD
        $this->_utentimodel = new Application_Model_Utenti();
=======
        $this->userModel = new Application_Model_Utenti();
>>>>>>> origin/Giù
    }

    public function authenticate($credentials)
    {
        $adapter = $this->getAuthAdapter($credentials);
        $auth    = $this->getAuth();
        $result  = $auth->authenticate($adapter);
<<<<<<< HEAD
     
        if (!$result->isValid()) {
            return false;
        }
        $user = $this->_utentimodel->getDatiUtenteByUserSet($credentials['username']);
=======

        if (!$result->isValid()) {
            return false;
        }
        $user = $this->userModel->getDatiUtenteByUserSet($credentials['username']);
>>>>>>> origin/Giù
        $auth->getStorage()->write($user);
        return true;
    }

    public function getAuth()
    {
        if (null === $this->_auth) {
            $this->_auth = Zend_Auth::getInstance();
        }
        return $this->_auth;
    }

    public function getIdentity()
    {
        $auth = $this->getAuth();
        if ($auth->hasIdentity()) {
            return $auth->getIdentity();
        }
        return false;
    }

    public function clear()
    {
        $this->getAuth()->clearIdentity();
    }

    public function getAuthAdapter($values)
    {
        $authAdapter = new Zend_Auth_Adapter_DbTable(
            Zend_Db_Table_Abstract::getDefaultAdapter(),
            'utente',
            'username',
            'password'
        );
        $authAdapter->setIdentity($values['username']);
        $authAdapter->setCredential($values['password']);
        return $authAdapter;
    }
}
