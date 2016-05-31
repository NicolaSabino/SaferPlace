<?php

class IndexController extends Zend_Controller_Action
{

    protected $registratiform ;
    protected $loginform;
    protected $_authService;
    
    public function init()
    {
        $this->view->loginform=$this->getLoginForm();
        $this->view->registratiform=$this->getRegistratiForm();
        $this->_authService = new Application_Service_Auth();

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
    }

    public function loginutenteAction()
    {
    }



    public function authenticateAction(){
        $request = $this->getRequest();

        /*$utentimodel=new Application_Model_Utenti();

        $username=$this->controllaParam('username');
        $password=$this->controllaParam('password');*/
        
        if (!$request->isPost()) {
            return $this->_helper->redirector('loginutente');
        }

        $form = $this->loginform;
        $form->isValid($this->getRequest()->getPost());  //isValid() è la funzione che effettivamente popola i campi della form

        if (!$form->isValid($request->getPost())) {
            echo "ci sono";
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('loginutente');
        }

        if (false === $this->_authService->authenticate($form->getValues())) {
            echo 'ci sono2';
            $form->setDescription('Autenticazione fallita. Riprova');
            return $this->render('loginutente');
        }
        /*else
        {
           /* if($utentimodel->isRightPassword($username,$password) === false){
                $form->setDescription('Attenzione: l\'username e/o la password inseriti sono errati.');
                return $this->render('loginutente');
            }

            else */

                //$this->getHelper('Redirector')->gotoSimple('checkin','livello1', $module = null);
           // return $this->_helper->redirector('index', $this->_authService->getIdentity()->role);

            return $this->_helper->redirector('index', $this->_authService->getIdentity()->livello);
        }

    public function getLoginForm(){
        $urlHelper = $this->_helper->getHelper('url');
        $this->loginform=new Application_Form_Loginform();

        $this->loginform->setAction($urlHelper->url(array(
            'controller' => 'index',
            'action' => 'authenticate'),
            'default'
        ));
        return $this->loginform;
    }
    public function verificaregistraAction()
    {
        $request = $this->getRequest();
        if (!$request->isPost()) {
            return $this->_helper->redirector('registrautente');
        }
        $form = $this->registratiform;
        if (!$form->isValid($request->getPost())) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('registrautente');
        }
        else
        {
            $datiform=$this->registratiform->getValues(); //datiform è un array

            $utentimodel=new Application_Model_Utenti();

            $username=$this->controllaParam('username'); //prendo l'username inserito nella form

            if($utentimodel->existUsername($username)) //controllo se l'username inserito esiste già nel db
            {
                $form->setDescription('Attenzione: l\'username che hai scelto non è disponibile.');
                return $this->render('registrautente');
            }
            else{
                $utentimodel->insertUtenti($datiform);
                $this->getHelper('Redirector')->gotoSimple('checkin','livello1', $module = null);
            }
        }
    }

    public function getRegistratiForm(){
        $urlHelper = $this->_helper->getHelper('url');
        $this->registratiform=new Application_Form_Registratiform();

        $this->registratiform->setAction($urlHelper->url(array(
            'controller' => 'index',
            'action' => 'verificaregistra'),
            'default'
        ));
        return $this->registratiform;
    }




}







