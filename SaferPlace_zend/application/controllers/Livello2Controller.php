<?php

class Livello2Controller extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function notifyAction()
    {
        
        $sel= new Application_Model_Notifica();
        //estraggo i risultati dell'esecuzione della query e li stampo
        print_r($sel->getEdPi(1));

        die;
        //$this->view->assign('notifiche',$notifiche->fetchAll());

    }


}



