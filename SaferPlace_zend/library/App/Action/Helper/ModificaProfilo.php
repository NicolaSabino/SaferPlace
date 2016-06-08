<?php

class App_Action_Helper_ModificaProfilo extends Zend_Controller_Action_Helper_Abstract
{
    public function getUrlArray ($level, $action) {

        switch($level){

            case 1:
                $urlarray = array(
                    'controller' => 'livello1',
                    'action' => ($action=='home') ?  'index' : $action);
                break;
            case 2:
                $urlarray = array(
                    'controller' => 'livello2',
                    'action' => ($action=='home') ?  'dashboard' : $action);
                break;
        }

    return $urlarray;
    }

    public function getForm($user, $level) {

        $urlHelper = Zend_Controller_Action_HelperBroker::getStaticHelper('url');
        $usermodel=new Application_Model_Utenti();
        $dati=$usermodel->getDatiUtenteByUserSet($user);
        $modificaform= new Application_Form_Registratiform();
        $modificaform->populate($dati);
        
        $modificaform->setAction($urlHelper->url(array(
            'controller' => 'livello'.$level,
            'action' => 'verificamodifica'),
            'default'
        ));
        
        return $modificaform;
    }

    public function verificaModifica($request,$level,$form)
    {
        
        if (!$request->isPost()) {
            $redirectorhelper = Zend_Controller_Action_HelperBroker::getStaticHelper('Redirector');
            return $redirectorhelper->gotoRoute($this->getUrlArray($level, 'modificadatiutente'));
        }
        
        if (!$form->isValid($request->getPost())) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->getActionController()->render('modificadatiutente');
        }
        else
        {
            $datiform=$form->getValues(); //datiform è un array

            $utentimodel=new Application_Model_Utenti();

            $utentimodel->updateUtentiSet($datiform);
            $urlarray = $this->getUrlArray($level,'home');
            $redirectorhelper = Zend_Controller_Action_HelperBroker::getStaticHelper('Redirector');

            $redirectorhelper->gotoRoute($urlarray);

        }
    }
}