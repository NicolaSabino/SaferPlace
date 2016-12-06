<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    /**inizializza il front controller e definisce il baseurl della nostra applicazione
     * ovvero l'url della cartella public della nostra applicazione
     */
    protected function _initSetupBaseUrl() {
            $this->bootstrap('frontcontroller'); //configura il frontcontroller
            $controller = Zend_Controller_Front::getInstance(); //prendiamo l'istanza del front controller appena creata e la mettiamo in una variabile
            $controller->setBaseUrl('/~grp_12/ZendProject/public'); //imposta il baseurl, path assoluto
    }

    /**
     * serve per reindirizzare il routing in modo corretto. se ho il front controller piazzato male ovvero non coincide con la cartella
     * del server non funziona, questa funzione fa una richiesta finta per far partire il meccanismo della posizione corretta
     */
    protected function _initRequest()
        // Aggiunge un'istanza di Zend_Controller_Request_Http nel Front_Controller
        // che permette di utilizzare l'helper baseUrl() nel Bootstrap.php
        // Necessario solo se la Document-root di Apache non è la cartella public/
        // necessaria per far girare più di un progetto su una macchina server
    {
        $this->bootstrap('FrontController');
        $front = $this->getResource('FrontController');
        $request = new Zend_Controller_Request_Http();
        $front->setRequest($request);
    }


    /**
     * instanzia e configura la view
     */
	  protected function _initViewSettings()
    {
        $this->bootstrap('view'); //istanzia un nuovo oggetto di tipo view
        $this->_view = $this->getResource('view');
        $this->_view->headMeta()->setCharset('UTF-8');
        $this->_view->headMeta()->appendHttpEquiv('Content-Language', 'it-IT'); //per gli accenti
        $this->_view->headLink()->appendStylesheet($this->_view->baseUrl('css/materialize.css')); //materialize
        $this->_view->headTitle('Safer Place');
    }


    /**
     * serve per aggiungere il namespace app reindirizzando alla cartella library App ogni volta che vine chiamata
     * una classe che inizia con App_
     */
    protected function _initDefaultModuleAutoloader()
    {
        $loader = Zend_Loader_Autoloader::getInstance();
        $loader->registerNamespace('App_');
        $this->getResourceLoader()
            ->addResourceType('modelResource','models/resources','Resource');
        //nome della risorsa, path in cui esplodere quando si incontra il nome del terzo parametro
    }

    /**
     * serve a fare il bootstrap di eventuali action helpers personalizzati, l'abbiamo usato nella modifica dei profili
     */
    protected function _initActionHelpers(){
		//helper per rendere uniformi le procedure di modifca dei dati degli utenti di livello 1 e 2
		Zend_Controller_Action_HelperBroker::addHelper( //instanziamo l'action helper modificaprofilo per averlo sempre disponibile
		    new App_Action_Helper_ModificaProfilo()
		);
    }

    //impostazioni db adapter
    protected function _initDbParms()
    {
        include_once(APPLICATION_PATH . '/../../include/connect.php'); //partiamo dal path della nostra applicazione
                                                            // sul server per includere il file con i dati per la connessione al db
        $db = new Zend_Db_Adapter_Pdo_Mysql(array(
            'host' => $HOST,
            'username' => $USER,
            'password' => $PASSWORD,
            'dbname' => $DB
        ));
        Zend_Db_Table_Abstract::setDefaultAdapter($db);
    }

    /**
     * utilizziamo l'ACL su base model, ogni volta che si fa il bootstrap si deve dire dove trovare i plugin dell'acl
     * instanzia ogni volta il plugin per l'acl
     */
    protected function _initFrontControllerPlugin()
    {
      $front = Zend_Controller_Front::getInstance();
      $front->registerPlugin(new App_Controller_Plugin_Acl());
    }

    


}




