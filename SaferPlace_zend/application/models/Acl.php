<?php

class Application_Model_Acl extends Zend_Acl
{
    /**
     * Usiamo la tecnica della whitelist
     * setta i permessi ad ogni tipo di utente.  
     * Application_Model_Acl constructor.
     */
    public function __construct()
    {

        // ACL per il livello 0
        $this->addRole(new Zend_Acl_Role('0')) //ruoli dell'utente
            ->add(new Zend_Acl_Resource('index')) //per risorsa si intente il controller
            ->add(new Zend_Acl_Resource('error'))
            ->allow('0', array('index','error'));


        // ACL per il livello1
        $this->addRole(new Zend_Acl_Role('1'), '0')
            ->add(new Zend_Acl_Resource('livello1'))
            ->allow('1','livello1');

        

        // ACL per il livello 2
        $this->addRole(new Zend_Acl_Role('2'), '0')
            ->add(new Zend_Acl_Resource('livello2'))
            ->allow('2','livello2');

        // ACL per il livello 3
        $this->addRole(new Zend_Acl_Role('3'), '0')
            ->add(new Zend_Acl_Resource('livello3'))
            ->allow('3','livello3');
        

    }
}