<?php

class Livello3Controller extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->layout->setLayout('layout3');
    }

    public function indexAction(){
        
        //inizializzo le form e le passo alla view
    
        $this->modificaFaq= new Application_Form_ModificaFaq();

        $this->modificaFaq->setAction($this->view->url(
            array(
                'controller' => 'livello1',
                'action' => 'checkin',
            )
        ));
        $this->view->modificaFaq=$this->modificaFaq;


        $edificiModel = new Application_Model_Edifici();
        $this->view->arrayEdifici = $edificiModel->getEdificiSet();
        
        $utenzaModel = new Application_Model_Utenza();
        $this->view->arrayUtenti = $utenzaModel->getUtenza();

        
        $faqModel = new Application_Model_Faq();
        $this->view->assign("faqSet",$faqModel->getFaqSet());


    }

    public function gestisciEdificioAction()
    {
        // action body
    }


}



