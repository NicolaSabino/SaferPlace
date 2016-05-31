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
    
    



    //loader di cucchia
    protected function _initDefaultModuleAutoloader()
    {
        $loader = Zend_Loader_Autoloader::getInstance();
        $loader->registerNamespace('App_');
        $this->getResourceLoader()
            ->addResourceType('modelResource','models/resources','Resource');
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




