<?php

class IndexController extends Zend_Controller_Action
{

    protected $registratiform = null;

    public function init()
    {
    }

    public function indexAction()
    {




    }

    public function controllaParam($param)
    {
        $parametro=0;
        if($this->hasParam("$param"))
            $parametro=$this->getParam("$param");
        return $parametro;
    }

    public function registrautenteAction()
    {
        $registra=$this->controllaParam('registra');

        $this->_helper->layout->setLayout('layout1');
        
        $this->loginform= new Application_Form_Loginform();

        $this->loginform->setAction($this->view->url(
            array(
                'controller' => 'livello1',
                'action' => 'checkin',
            )
        ));


        $this->registratiform= new Application_Form_Registratiform();
        
        $this->registratiform->setAction($this->view->url(
            array(
                'controller' => 'index',
                'action' => 'registrautente',
            )
        ));

        $this->view->registratiform=$this->registratiform;
        $this->view->loginform=$this->loginform;
        $this->view->registra=$registra;
        
        $nome=$this->controllaParam('Nome');
        $cognome=$this->controllaParam('Cognome');
        $telefono=$this->controllaParam('telefono');
        $username=$this->controllaParam('username');
        $password=$this->controllaParam('password');
        $email=$this->controllaParam('email');
        $eta=$this->controllaParam('eta');
        $genere=$this->controllaParam('genere');

        //$utentimodel=new Application_Model_Utenti();
       // $utentimodel->insertUtenti($nome,$cognome,$telefono, $email,$username,$password,$genere,$eta);

       // $this->getHelper('Redirector')->gotoSimple('checkin','livello1', $module = null);
    }


}





