<?php

class Application_Model_Acl extends Zend_Acl
{
    public function __construct()
    {
<<<<<<< HEAD
=======
        // ACL per il livello 0
>>>>>>> origin/Giù
        $this->addRole(new Zend_Acl_Role('0'))
            ->add(new Zend_Acl_Resource('index'))
            ->add(new Zend_Acl_Resource('error'))
            ->allow('0', array('index','error'));

<<<<<<< HEAD
=======
        // ACL per il livello1
>>>>>>> origin/Giù
        $this->addRole(new Zend_Acl_Role('1'), '0')
            ->add(new Zend_Acl_Resource('livello1'))
            ->allow('1','livello1');

<<<<<<< HEAD
=======
        // ACL per il livello 2
>>>>>>> origin/Giù
        $this->addRole(new Zend_Acl_Role('2'), '1')
            ->add(new Zend_Acl_Resource('livello2'))
            ->allow('2','livello2');

<<<<<<< HEAD
        $this->addRole(new Zend_Acl_Role('3'), '2')
            ->add(new Zend_Acl_Resource('livello3'))
            ->allow('3','livello3');


=======
        // ACL per il livello 3
        
        $this->addRole(new Zend_Acl_Role('3'), '2')
            ->add(new Zend_Acl_Resource('livello3'))
            ->allow('3','livello3');
>>>>>>> origin/Giù
    }
}