<?php

class Livello2Controller extends Zend_Controller_Action
{
    protected $_authService;
    protected $modelUtente;
    protected $user;
    protected $evacuazioneform = null;
    protected $modificaform     = null;
    protected $pianodifugaform = null;

    public function init()
    {
        $this->_authService = new Application_Service_Auth();
        $this->_helper->layout->setLayout('layout2');
        $this->user= $this->_authService->getIdentity()->current()->username;
        $this->modelUtente= new Application_Model_UtenteStaff($this->user);
        $this->view->profiloform= $this->getModificaForm();
    }

    public function indexAction()
    {
        // action body
    }

    public function notifyAction()
    {

        
       // $notifiche = new Application_Resource_Notifica();
       // print_r($modelUtente->getEdificiGestiti());
        die;
        //estraggo i risultati dell'esecuzione della query e li stampo
        $this->view->assign("notifiche", $utente->getNotificheEmergenze());


        //$this->view->assign('notifiche',$notifiche->fetchAll());

    }

    public function dashboardAction()
    {
        $edificigestiti = $this->modelUtente->getEdificiGestiti($this->user);
        $persEdificio = $this->modelUtente->getPersEdGest($edificigestiti);

        $this->view->assign('persedificio', $persEdificio);

        if (($edificio = $this->controllaParam('edificio')) && ($piano = $this->controllaParam('piano'))) {

            $persPiano = $this->modelUtente->getPersPiano($edificio, $piano);
            $persPerStanza = $this->modelUtente->getNumPersStanze($edificio, $piano );
            

            $this->view->assign('persperstanza', $persPerStanza);
            $this->view->assign('perspiano', $persPiano);
            $this->view->assign("pianta", $edificio . ' Piano ' . $piano . '.jpg');
        }

            $this->view->assign("edifici_e_piani",$edificigestiti);

        if ($notifiche = $this->modelUtente->getNotificheEmergenze())
            $this->view->assign("notifiche", $notifiche);

        if ($evacuazioni = $this->modelUtente->fetchEventi())
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
        

        if (($edificio = $this->controllaParam('edificio')) && ($piano = $this->controllaParam('piano')))
            $this->view->assign("pianta", $edificio . ' Piano ' . $piano . '.jpg');
        $this->modelUtente->deleteNotification($this->controllaParam('id'));
        $this->getHelper('Redirector')->gotoRoute(array('controller'=>'livello2', 'action'=>'dashboard',
                                                    'edificio'=> $edificio, 'piano'=>$piano));
    }

    public function interruptAction()
    {
       

        if (($edificio = $this->controllaParam('edificio')) && ($piano = $this->controllaParam('piano')))
            $this->view->assign("pianta", $edificio . ' Piano ' . $piano . '.jpg');
        
        if ($id = $this->controllaParam('interrupt'));
            $this->modelUtente->delEvento($id);
        $this->getHelper('Redirector')->gotoRoute(array('controller'=>'livello2', 'action'=>'dashboard',
            'edificio'=> $edificio, 'piano'=>$piano));
    }

    public function getEvacuazioneForm($edificio,$piano,$tipo)
    {


        $urlHelper = $this->_helper->getHelper('url');
        $this->evacuazioneform= new Application_Form_Evacuazioneform($this->user,$edificio,$piano,$tipo);
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

        $edificio = $this->getRequest()->getPost('edificio');
        $piano = $this->getRequest()->getPost('piano');
        
        if ($zona  = $this->getRequest()->getPost('zona'))
            $this->view->assign('zona', $zona);
        if ($tipo  = $this->getRequest()->getPost('tipo'))
            $this->view->assign('tipo', $tipo);

        $this->view->assign('edificio', $edificio);
        $this->view->assign('piano', $piano);
        $this->view->assign('pianifuga', $this->modelUtente->getPianiFuga($edificio, $piano));
        $this->view->assign('zone', $this->modelUtente->getZone($edificio, $piano));
        
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













