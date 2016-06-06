<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initSetupBaseUrl() {
            $this->bootstrap('frontcontroller');
            $controller = Zend_Controller_Front::getInstance();
            $controller->setBaseUrl('/SaferPlace/SaferPlace_zend/public');
    }


    // Aggiunge un'istanza di Zend_Controller_Request_Http nel Front_Controller
    // che permette di utilizzare l'helper baseUrl() nel Bootstrap.php
    // Necessario solo se la Document-root di Apache non è la cartella public/
    //necessaria per far girare più di un progetto su una macchina server
    protected function _initRequest()
    {
        $this->bootstrap('FrontController');
        $front = $this->getResource('FrontController');
        $request = new Zend_Controller_Request_Http();
        $front->setRequest($request);
    }


    //loader
    protected function _initDefaultModuleAutoloader()
    {
        $loader = Zend_Loader_Autoloader::getInstance();
        $loader->registerNamespace('App_');
        $this->getResourceLoader()
            ->addResourceType('modelResource','models/resources','Resource');
    }

    protected function _initFrontControllerPlugin()
    {
        $front = Zend_Controller_Front::getInstance();
        $front->registerPlugin(new App_Controller_Plugin_Acl());
    }

    protected function _initViewSettings()
    {
        $this->bootstrap('view');
        $this->_view = $this->getResource('view');
        $this->_view->headMeta()->setCharset('UTF-8'); //Charset
        $this->_view->headMeta()->appendHttpEquiv('Content-Language', 'it-IT'); //Lingua
        $this->_view->headLink()->appendStylesheet($this->_view->baseUrl('css/materialize.css')); //CSS Materialize
        $this->_view->headLink()->appendStylesheet("https://fonts.googleapis.com/icon?family=Material+Icons"); //Google's Icons
        $this->_view->headTitle('Safer Place'); //Titolo
        
    }


    //impostazioni db adapter
    protected function _initDbAdapter(){
        $dbAdapter = Zend_Db::factory('PDO_mysql', array(
            'host'     => 'localhost',
            'username' => 'root',
            'password' => '',
            'dbname'   => 'sp_db',
            'charset'  => 'utf8'
        ));
        Zend_Db_Table::setDefaultAdapter($dbAdapter);

    }

    protected function _initActionHelpers(){
        //helper per rendere uniformi le procedur edi modifca dei dati degli utenti di livello 1 e 2
        Zend_Controller_Action_HelperBroker::addHelper(
            new App_Action_Helper_ModificaProfilo()

        );
    }



}




