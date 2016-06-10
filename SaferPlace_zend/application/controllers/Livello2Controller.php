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
        $this->evacuazioneform = $this->getEvacuazioneForm(0,0,0);
        $this->view->evacuazioneform= $this->evacuazioneform;

    }

    public function indexAction()
    {
        $this->getHelper('Redirector')->gotoRoute(array('controller'=>'livello2', 'action'=>'dashboard'));
    }

    //Azione di test
    public function notifyAction()
    {

        $this->modelUtente->getSegnalazioniStanze('Univpm',1);
        
        die;
        //estraggo i risultati dell'esecuzione della query e li stampo



        //$this->view->assign('notifiche',$notifiche->fetchAll());

    }

    public function dashboardAction()
    {
        
        $edificigestiti = $this->modelUtente->getEdificiGestiti($this->user);
        $persEdificio = $this->modelUtente->getPersEdGest($edificigestiti);

        $this->view->assign('persedificio', $persEdificio);

        // controlla se i parametri sono stati passati, in caso affermativo controlla che siano corretti
        if (($edificio = $this->controllaParam('edificio')) && ($piano = $this->controllaParam('piano')) &&
            (array_key_exists($edificio, $edificigestiti )) && (in_array($piano, $edificigestiti[$edificio] )))
        {


            $persPiano = $this->modelUtente->getPersPiano($edificio, $piano);
            $persPerStanza = $this->modelUtente->getNumPersStanze($edificio, $piano );
            $segnalazionistanze = $this->modelUtente->getSegnalazioniStanze($edificio,$piano);

            $this->view->assign('edificio', $edificio);
            $this->view->assign('piano', $piano);
            $this->view->assign('segnalazionistanze', $segnalazionistanze);
            $this->view->assign('persperstanza', $persPerStanza);
            $this->view->assign('perspiano', $persPiano);
            $this->view->assign("pianta", $edificio . ' Piano ' . $piano . '.jpg');
        }

            $this->view->assign("edifici_e_piani",$edificigestiti);

        if ($notifiche = $this->modelUtente->getNotificheEmergenze() == null)
            $this->getHelper('Redirector')->gotoRoute(array('controller'=>'livello2', 'action'=>'nogestione'));
        else
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
        $this->evacuazioneform= new Application_Form_Evacuazioneform($this->user);
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

        if ($piano)
            $this->view->assign('piano', $piano);
        $this->view->evacuazioneform= $this->getEvacuazioneForm($edificio,$piano,$tipo);
        
    }



    public function sceglipdfAction()
    {
        $request = $this->getRequest();
        if (!$request->isPost()) {
            $redirectorhelper = Zend_Controller_Action_HelperBroker::getStaticHelper('Redirector');
            return $redirectorhelper->gotoRoute('livello2', 'evacuazione');
        }

        if (!$this->evacuazioneform->isValid($request->getPost())) {
            $this->evacuazioneform->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('evacuazione');
        }
        else {
            $edificio = $this->getRequest()->getPost('edificio');
            $piano = $this->getRequest()->getPost('piano');

            if ($zona = $this->getRequest()->getPost('zona'))
                $this->view->assign('zona', $zona);
            if ($tipo = $this->getRequest()->getPost('tipo'))
                $this->view->assign('tipo', $tipo);

            $this->view->assign('edificio', $edificio);
            $this->view->assign('piano', $piano);
            $this->view->assign('pianifuga', $this->modelUtente->getPianiFuga($edificio, $piano));
            $this->view->assign('zone', $this->modelUtente->getZone($edificio, $piano));
        }
    }

    public function avviaevacuazioneAction()
    {

        $idPianoFuga = $this->controllaParam('idPianoFuga');
        $edificio =$this->controllaParam('edificio');
        $piano    =$this->controllaParam('piano');
        $zona     =$this->controllaParam('zona');
        $idSegnalazione = $this->controllaParam('segnalazione') ? $this->controllaParam('segnalazione') : null;
        $tipo = $this->controllaParam('tipo');

        $this->modelUtente->avviaEvac($edificio,$tipo,$idSegnalazione, $piano, $zona, $idPianoFuga);


        $this->getHelper('Redirector')->gotoRoute(array('controller'=>'livello2', 'action'=>'dashboard'), null, true);
            
            
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
        $this->getHelper('ModificaProfilo')->verificaModifica($request,2,$form,$this->user);
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
    
    public function gestionepdfAction(){

        if ( ($edificio = $this->controllaParam('edificio')) && ($piano = $this->controllaParam('piano')) ) {
            
            $pianifuga = $this->modelUtente->getPianiFuga($edificio,$piano);
            
            $this->view->assign('edificio', $edificio);
            $this->view->assign('piano', $piano);
            $this->view->assign('pianifuga', $pianifuga);
        }
        else {
            $this->getHelper('Redirector')->gotoRoute(array('controller'=>'error', 'action0'=>'error'));
        }
        
    }
    
    public function abilitapdfAction(){

        if ( ($edificio = $this->controllaParam('edificio')) && ($piano = $this->controllaParam('piano'))
        && ($idPianoFuga = $this->controllaParam('idPianoFuga'))) {

            $this->modelUtente->sceltaPdf($edificio, $piano, $idPianoFuga);

            $this->getHelper('Redirector')->gotoRoute(array('controller'=>'livello2', 'action'=>'dashboard',
                                                      'edificio'=> $edificio, 'piano'=> $piano));
        }

        else {
            $this->getHelper('Redirector')->gotoRoute(array('controller'=>'error', 'action0'=>'error'));
        }
    }

    public function nogestioneAction(){
        
    }

}













