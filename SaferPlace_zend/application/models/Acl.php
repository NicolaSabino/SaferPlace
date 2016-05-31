<?php

class Application_Model_Acl extends Zend_Acl
{
    public function __construct()
    {
        $this->addRole(new Zend_Acl_Role('0'))
            ->add(new Zend_Acl_Resource('index'))
            ->add(new Zend_Acl_Resource('error'))
            ->allow('0', array('index','error'));

        $this->addRole(new Zend_Acl_Role('1'), '0')
            ->add(new Zend_Acl_Resource('livello1'))
            ->allow('1','livello1');

        $this->addRole(new Zend_Acl_Role('2'), '1')
            ->add(new Zend_Acl_Resource('livello2'))
            ->allow('2','livello2');

        $this->addRole(new Zend_Acl_Role('3'), '2')
            ->add(new Zend_Acl_Resource('livello3'))
            ->allow('3','livello3');


    }
}