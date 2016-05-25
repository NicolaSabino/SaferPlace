<?php

class Application_Form_Loginform extends App_Form_Abstract
{
    public function init()
    {
        $this->setMethod('post');
        $this->setName('loginform'); //setta name e id del form



        $this->addElement('text', 'username', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'required'   => true,
            'label'      => 'Username',
            'decorators' => $this->elementDecorators,
        ));



        $this->addElement('password', 'password', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'required'   => true,
            'label'      => 'Password',
            'decorators' => $this->elementDecorators,
        ));

        $this->addElement('submit', 'Accedi', array(
            'label'    => 'Login',
            'class' => 'btn red white-text',

            'decorators' => $this->buttonDecorators,
        ));

        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'a', 'class' => 'zend_form')),
            array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
        ));
    }
}