<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    //non so se va definito comunque il baseurl


    protected function _initSetupBaseUrl() {
            $this->bootstrap('frontcontroller');
            $controller = Zend_Controller_Front::getInstance();
            $controller->setBaseUrl('/~grp_12/ZendProject/public');
    }

    protected function _initRequest()
        // Aggiunge un'istanza di Zend_Controller_Request_Http nel Front_Controller
        // che permette di utilizzare l'helper baseUrl() nel Bootstrap.php
        // Necessario solo se la Document-root di Apache non è la cartella public/
        //necessaria per far girare più di un progetto su una macchina server
    {
        $this->bootstrap('FrontController');
        $front = $this->getResource('FrontController');
        $request = new Zend_Controller_Request_Http();
        $front->setRequest($request);
    }
    
    
	  protected function _initViewSettings()
    {
        $this->bootstrap('view');
        $this->_view = $this->getResource('view');
        $this->_view->headMeta()->setCharset('UTF-8');
        $this->_view->headMeta()->appendHttpEquiv('Content-Language', 'it-IT');
        $this->_view->headLink()->appendStylesheet($this->_view->baseUrl('css/materialize.css'));
        $this->_view->headTitle('Safer Place');
    }



    //loader
    protected function _initDefaultModuleAutoloader()
    {
        $loader = Zend_Loader_Autoloader::getInstance();
        $loader->registerNamespace('App_');
        $this->getResourceLoader()
            ->addResourceType('modelResource','models/resources','Resource');
    }
    
    protected function _initActionHelpers(){
		//helper per rendere uniformi le procedur edi modifca dei dati degli 				utenti di livello 1 e 2
		Zend_Controller_Action_HelperBroker::addHelper(
		    new App_Action_Helper_ModificaProfilo()

		);
	
    }

    //impostazioni db adapter
    protected function _initDbParms()
    {
        include_once(APPLICATION_PATH . '/../../include/connect.php');
        $db = new Zend_Db_Adapter_Pdo_Mysql(array(
            'host' => $HOST,
            'username' => $USER,
            'password' => $PASSWORD,
            'dbname' => $DB
        ));
        Zend_Db_Table_Abstract::setDefaultAdapter($db);
    }


    


}




