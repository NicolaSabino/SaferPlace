<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
    }

    public function indexAction()
    {
        $this->loginform= new Application_Form_Loginform();

        $this->loginform->setAction($this->view->url(
            array(
                'controller' => 'livello1',
                'action' => 'checkin',
            )
        ));
        $this->view->loginform=$this->loginform;

        $this->registratiform= new Application_Form_Registratiform();

        $this->registratiform->setAction($this->view->url(
            array(
                'controller' => 'livello1',
                'action' => 'checkin',
            )
        ));
        $this->view->registratiform=$this->registratiform;
    }


}



