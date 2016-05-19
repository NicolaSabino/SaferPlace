<?php

class FaqController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        //istanzio l'insieme delle faq estraendole dal model
        $faqModel = new Application_Model_Faq();
        //assegno alla view di faq la variabile FAQSET attraverso il metodo assign
        $this->view->assign("faqSet",$faqModel->getFaqSet());
    }


}

