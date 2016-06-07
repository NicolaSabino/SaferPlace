<?php

class Application_Form_Gestionezone extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');
        $this->setName('registratiform'); //setta name e id del form



        $this->addElement('text', 'zona', array(
            'filters'       => array('StringTrim'),
            'required'      => true,
            'label'         => 'Zona',
            'class'         =>'black-text'

        ));

        $this->addElement('text', 'stanza', array(
            'filters'       => array('StringTrim'),
            'required'      => true,
            'validators'        => array(
                array('StringLength', true, array(0, 4),array('Digits'))
            ),
            'label'         => 'Stanza',
            'class'         =>'black-text',


        ));

        $this->addElement('submit', 'ok', array(
            'class' => 'btn green white-text'
        ));

        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'a', 'class' => 'zend_form')),
            array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
        ));
    }


}

