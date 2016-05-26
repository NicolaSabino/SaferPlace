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


        ));

        $this->addElement('text', 'Cognome', array(
            'filters'    => array('StringTrim'),
            'required'   => true,
            'label'=> 'Cognome',
            'class' =>'black-text',


        ));

        $this->addElement('select', 'genere', array(
            'label' => 'Genere',
            'filters'    => array('StringTrim'),
            'required'   => true,
            'multiOptions' => array('m'=>'Uomo','f'=>'Donna'),
            'class' =>'black-text',

        ));

        $this->addElement('text', 'eta', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(0, 3))
            ),
            'required'         => true,
            'label'      => 'Età',
            'class' =>'black-text',


        ));

        $this->addElement('text', 'telefono', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 64))
            ),
            'required'         => true,
            'label'      => 'Telefono',
            'class' =>'black-text',


        ));


        $this->addElement('text', 'username', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 64))
            ),
            'required'         => true,
            'label'      => 'Username',
            'class' =>'black-text',


        ));

        $this->addElement('password', 'password', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 64))
            ),
            'required'         => true,
            'label'      => 'Password',
            'class' =>'black-text',


        ));


        $this->addElement('text', 'email', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 64))
            ),
            'required'         => true,
            'label'      => 'Email',
            'class' =>'black-text',


        ));

        $this->addElement('submit', 'Registrati', array(
            'class' => 'btn waves-yellow green',
        ));

        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'a', 'class' => 'zend_form')),
            array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
        ));
    }
}