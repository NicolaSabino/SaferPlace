<?php

class App_Action_Helper_ModificaProfilo extends Zend_Controller_Action_Helper_Abstract
{
    /**
     * si ha un array contenente l'url della home in cui l'utente va reindirizzato oppure può essere utilizzato
     * per qualsiasi azione in baso al livello dell'utente
     * @param $level
     * @param $action
     * @return array
     */
    public function getUrlArray ($level, $action) {

        switch($level){ //livello dell'utente (1,2,3)

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

            case 3:
                $urlarray = array(
                    'controller' => 'livello3',
                    'action' => ($action=='home') ?  'index' : $action);
                break;
        }

    return $urlarray;
    }


    /**
     * instanzia la form per la modifica del profilo. passiamo nome utente e livello dell'utente
     * l'url helper ci permette di avere come return un url che sia corretto nel routing di zend.
     * @param $user
     * @param $level
     * @return Application_Form_Registratiform
     */
    public function getForm($user, $level) {

        $urlHelper = Zend_Controller_Action_HelperBroker::getStaticHelper('url');
        $usermodel=new Application_Model_Utenti(); //instanzia il model utenti
        $dati=$usermodel->getDatiUtenteByUserSet($user); //recupero i dati dell'utente
        $modificaform= new Application_Form_Registratiform();
        $modificaform->populate($dati);
        
        $modificaform->setAction($urlHelper->url(array(
            'controller' => 'livello'.$level,
            'action' => 'verificamodifica'),
            'default'
        ));
        
        return $modificaform;
    }

    
    public function verificaModifica($request,$level,$form,$username)
    {

        if (!$request->isPost()) { //rileva semplicemente il tipo della richiesta
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

            if($utentimodel->existUsername($datiform['username']) && $datiform['username'] != $username) //controllo se l'username inserito esiste già nel db
            {
                $form->setDescription('Attenzione: l\'username che hai scelto non è disponibile.');
                return $this->getActionController()->render('modificadatiutente');
            }
            $authservice = new Application_Service_Auth();
            $authservice->getAuth()->getIdentity()->current()->username = $datiform['username'];
            $utentimodel->updateUtentiSet($datiform, $username);
            $urlarray = $this->getUrlArray($level,'home'); // per reindirizzare l'utente nell'istanza corretta
            $redirectorhelper = Zend_Controller_Action_HelperBroker::getStaticHelper('Redirector');
            
            $redirectorhelper->gotoRoute($urlarray); //ontroller action helper equivalente all'url action helper

        }
    }

}