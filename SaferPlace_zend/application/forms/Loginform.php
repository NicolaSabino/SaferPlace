<?php

class Application_Form_Loginform extends Zend_Form
{
    public function init()
    {
        $this->setMethod('post');
        $this->setName('loginform'); //setta name e id del form
        $this->addElement('text', 'username', array(
            'filters'    => array('StringTrim'),
            'required'   => true,
            'placeholder'=> 'Username',
        ));
        $this->addElement('password', 'password', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 64))
            ),
            'required'         => true,
            'placeholder'      => 'Password',
        ));
        $this->addElement('submit', 'Accedi', array(
            'class' => 'btn red white-text'
        ));

        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'a', 'class' => 'zend_form')),
            array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
        ));
    }
}