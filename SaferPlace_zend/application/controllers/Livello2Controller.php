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
        $this->modificaform = $this->getModificaForm();
        $this->view->modificaform= $this->modificaform;
    }

    public function indexAction()
    {
        // action body
    }

    public function notifyAction()
    {
        $pianires= new Application_Resource_Piani();
        $this->getEvacuazioneForm(null,null,null);
        $multipiani=$pianires->getPianiByEdificio($_GET['edificio']);
        foreach ($multipiani as $item){

            $opzioni[$item->numeroPiano] = $item->numeroPiano;
        }

        $this->evacuazioneform->getElement('piano')->addMultiOptions($opzioni);
       // $notifiche = new Application_Resource_Notifica();
       // print_r($modelUtente->getEdificiGestiti());
        print_r($this->evacuazioneform->getElement('piano')->getMultiOptions());
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
        return $this->getHelper('ModificaProfilo')->getForm($this->user, 2);


    }
    public function modificadatiutenteAction(){

       
    }

    public function verificamodificaAction()
    {
        $request = $this->getRequest();
        $form = $this->modificaform;
        $this->getHelper('ModificaProfilo')->verificaModifica($request,2,$form);
    }

    public function ajaxedifAction(){

        $this->_helper->getHelper('layout')->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        $opzioni = $this->modelUtente->pianiEdToArray($_POST['edificio']);
        $response = $this->_helper->json($opzioni);

        if ($response !== null) {
            $this->getResponse()->setHeader('Content-type','application/json')->setBody($response);
        }

        
    }

    public function ajaxpianoAction(){

        $this->_helper->getHelper('layout')->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        
        $opzioni = $this->modelUtente->zonePianoToArray($_POST["edificio"], $_POST['piano']);
        $response = $this->_helper->json($opzioni);

        if ($response !== null) {
            $this->getResponse()->setHeader('Content-type','application/json')->setBody($response);
        }


    }
}













