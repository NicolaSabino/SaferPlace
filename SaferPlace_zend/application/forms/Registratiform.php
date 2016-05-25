<?php

class Application_Form_Registratiform extends App_Form_Abstract
{
    public function init()
    {
        $this->setMethod('post');
        $this->setName('registratiform'); //setta name e id del form
        $this->addElement('text', 'Nome', array(
            'filters'    => array('StringTrim'),
            'required'   => true,
            'label'=> 'Nome',
            'class' =>'black-text',
            'decorators' => $this->elementDecorators,

        ));
        $this->addElement('text', 'Cognome', array(
            'filters'    => array('StringTrim'),
            'required'   => true,
            'label'=> 'Cognome',
            'class' =>'black-text',
            'decorators' => $this->elementDecorators,

        ));

        $this->addElement('text', 'username', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 64))
            ),
            'required'         => true,
            'label'      => 'Username',
            'class' =>'black-text',
            'decorators' => $this->elementDecorators,

        ));

        $this->addElement('password', 'password', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 64))
            ),
            'required'         => true,
            'label'      => 'Password',
            'class' =>'black-text',
            'decorators' => $this->elementDecorators,

        ));


        $this->addElement('text', 'email', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 64))
            ),
            'required'         => true,
            'label'      => 'Email',
            'class' =>'black-text',
            'decorators' => $this->elementDecorators,

        ));

        $this->addElement('submit', 'Registrati', array(
            'class' => 'btn waves-yellow green',
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