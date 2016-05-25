<?php

class Application_Form_Registratiform extends Zend_Form
{
    public function init()
    {
        $this->setMethod('post');
        $this->setName('registratiform'); //setta name e id del form
        $this->addElement('text', 'Nome', array(
            'filters'    => array('StringTrim'),
            'required'   => true,
            'placeholder'=> 'Nome',
            'class' =>'black-text'
        ));
        $this->addElement('text', 'Cognome', array(
            'filters'    => array('StringTrim'),
            'required'   => true,
            'placeholder'=> 'Cognome',
            'class' =>'black-text'
        ));

        $this->addElement('text', 'username', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 64))
            ),
            'required'         => true,
            'placeholder'      => 'Username',
            'class' =>'black-text'
        ));

        $this->addElement('password', 'password', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 64))
            ),
            'required'         => true,
            'placeholder'      => 'Password',
            'class' =>'black-text'
        ));


        $this->addElement('text', 'email', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 64))
            ),
            'required'         => true,
            'placeholder'      => 'Email',
            'class' =>'black-text'
        ));

        $this->addElement('submit', 'Registrati', array(
            'class' => 'btn waves-yellow green'
        ));

        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'a', 'class' => 'zend_form')),
            array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
        ));
    }
}