<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{


    protected function _initSetupBaseUrl() {
            $this->bootstrap('frontcontroller');
            $controller = Zend_Controller_Front::getInstance();
            $controller->setBaseUrl('/SaferPlace/SaferPlace_zend/public');
    }

        //questo metodo serve a caricare le classi presenti dentro model
    protected function _initAutoLoad(){
        $modelLoader= new Zend_Application_Module_Autoloader(array(
            'namespace' => '',
            'basePath' => APPLICATION_PATH //È definito dentro public/index.php
        ));

        return $modelLoader;
    }

    protected function _initDbAdapter(){
        $dbAdapter = Zend_Db::factory('PDO_mysql', array(
            'host'     => 'localhost',
            'username' => 'root',
            'password' => '',
            'dbname'   => 'sp_db'
        ));
        Zend_Db_Table::setDefaultAdapter($dbAdapter);

    }


/*
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


*/
  //loader di cucchia
    protected function _initDefaultModuleAutoloader()
    {
        $loader = Zend_Loader_Autoloader::getInstance();
        $loader->registerNamespace('App_');
        $this->getResourceLoader()
            ->addResourceType('modelResource','models/resources','Resource');
    }
}




