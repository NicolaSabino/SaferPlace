<?php

class Livello1Controller extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function checkinAction()
    {
        $edificimodel=new Application_Model_Edifici();
        $this->view->u = $edificimodel->getEdifici()->toArray();
    }

    public function checkinbAction()
    {
        // action body
    }


}





