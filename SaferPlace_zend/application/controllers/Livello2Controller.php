<?php

class Livello2Controller extends Zend_Controller_Action
{
    protected $user = 'nicolanabbo';
    protected $evacuazioneform = null;
    protected $modificaform     = null;
    protected $pianodifugaform = null;

    public function init()
    {
        $this->_helper->layout->setLayout('layout2');
        $this->view->profiloform= $this->getModificaForm();
    }

    public function indexAction()
    {
        // action body
    }

    public function notifyAction()
    {

        $modelUtente= new Application_Model_UtenteStaff();
       // $notifiche = new Application_Resource_Notifica();
        print_r($modelUtente->getEdificiGestiti());
        die;
        //estraggo i risultati dell'esecuzione della query e li stampo
        $this->view->assign("notifiche", $utente->getNotificheEmergenze());


        //$this->view->assign('notifiche',$notifiche->fetchAll());

    }

    public function dashboardAction()
    {
        $modelUtente = new Application_Model_UtenteStaff();
        $edificigestiti = $modelUtente->getEdificiGestiti('nicolanabbo');
        $persEdificio = $modelUtente->getPersEdGest($edificigestiti);

        $this->view->assign('persedificio', $persEdificio);

        if (($edificio = $this->controllaParam('edificio')) && ($piano = $this->controllaParam('piano'))) {

            $persPiano = $modelUtente->getPersPiano($edificio, $piano);
            $persPerStanza = $modelUtente->getNumPersStanze($edificio, $piano );
            

            $this->view->assign('persperstanza', $persPerStanza);
            $this->view->assign('perspiano', $persPiano);
            $this->view->assign("pianta", $edificio . ' Piano ' . $piano . '.jpg');
        }

            $this->view->assign("edifici_e_piani",$edificigestiti);

        if ($notifiche = $modelUtente->getNotificheEmergenze())
            $this->view->assign("notifiche", $notifiche);

        if ($evacuazioni = $modelUtente->fetchEventi())
            $this->view->assign("evacuazioni", $evacuazioni);


    }

    public function controllaParam($param)
    {
        $parametro=0;
        if($this->hasParam("$param"))
            $parametro=$this->getParam("$param");
        return $parametro;
    }

    public function delnotifAction()
    {
        $modelUtente= new Application_Model_UtenteStaff();

        if (($edificio = $this->controllaParam('edificio')) && ($piano = $this->controllaParam('piano')))
            $this->view->assign("pianta", $edificio . ' Piano ' . $piano . '.jpg');
        $modelUtente->deleteNotification($this->controllaParam('id'));
        $this->getHelper('Redirector')->gotoRoute(array('controller'=>'livello2', 'action'=>'dashboard',
                                                    'edificio'=> $edificio, 'piano'=>$piano));
    }

    public function interruptAction()
    {
        $modelUtente= new Application_Model_UtenteStaff();

        if (($edificio = $this->controllaParam('edificio')) && ($piano = $this->controllaParam('piano')))
            $this->view->assign("pianta", $edificio . ' Piano ' . $piano . '.jpg');
        
        if ($id = $this->controllaParam('interrupt'));
            $modelUtente->delEvento($id);
        $this->getHelper('Redirector')->gotoRoute(array('controller'=>'livello2', 'action'=>'dashboard',
            'edificio'=> $edificio, 'piano'=>$piano));
    }

    public function getEvacuazioneForm($edificio,$piano,$tipo)
    {


        $urlHelper = $this->_helper->getHelper('url');
        $this->evacuazioneform= new Application_Form_Evacuazioneform($edificio,$piano,$tipo);
        if ($edificio && $piano && $tipo)
            $this->evacuazioneform->populate($edificio, $piano, $tipo);
        $this->evacuazioneform->setAction($urlHelper->url(array(
            'controller' => 'livello2',
            'action' => 'sceglipdf'),
            'default'
        ));
        
        return $this->evacuazioneform;
    }

    public function evacuazioneAction()
    {
        $edificio = $this->controllaParam('edificio');
        $piano    = $this->controllaParam('piano');
        $tipo     = $this->controllaParam('tipo');
        
        
        $this->view->evacuazioneform= $this->getEvacuazioneForm($edificio,$piano,$tipo);
        
    }

    public function sceglipdfAction()
    {
        $utentemodel = new Application_Model_UtenteStaff();
        $edificio = $this->getRequest()->getPost('edificio');
        $piano = $this->getRequest()->getPost('piano');
        
        if ($zona  = $this->getRequest()->getPost('zona'))
            $this->view->assign('zona', $zona);
        if ($tipo  = $this->getRequest()->getPost('tipo'))
            $this->view->assign('tipo', $tipo);

        $this->view->assign('edificio', $edificio);
        $this->view->assign('piano', $piano);
        $this->view->assign('pianifuga', $utentemodel->getPianiFuga($edificio, $piano));
        $this->view->assign('zone', $utentemodel->getZone($edificio, $piano));
        
    }

    public function avviaevacuazioneAction()
    {
        $utenteModel = new Application_Model_UtenteStaff();
        $idPianoFuga = $this->controllaParam('idPianoFuga');
        $edificio =$this->controllaParam('edificio');
        $piano    =$this->controllaParam('piano');
        $zona     =$this->controllaParam('zona');
        $idSegnalazione = $this->controllaParam('segnalazione') ? $this->controllaParam('segnalazione') : null;
        $tipo = $this->controllaParam('tipo');
        
        $utenteModel->avviaEvac($edificio,$tipo,$idSegnalazione, $piano, $zona, $idPianoFuga);


        $this->getHelper('Redirector')->gotoRoute(array('controller'=>'livello2', 'action'=>'dashboard'));
            
            
    }

    public function getModificaform()
    {
        $urlHelper = $this->_helper->getHelper('url');

        $usermodel=new Application_Model_Utenti();
        $dati=$usermodel->getDatiUtenteByUserSet($this->user);
        $this->modificaform= new Application_Form_Registratiform($dati);

        $this->modificaform->setAction($urlHelper->url(array(
            'controller' => 'livello1',
            'action' => 'verificamodifica'),
            'default'
        ));
        return $this->modificaform;
    }
    public function modificaAction(){
        $this->getHelper('Redirector')->gotoRoute(array('controller'=>'livello1', 'action'=>'modificadatiutente'));;
    }


}













