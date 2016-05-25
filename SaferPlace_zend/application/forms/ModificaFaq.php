<?php

class Application_Form_ModificaFaq extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');
        $this->setName('modificaFaq'); //setta name e id del form
        $this->addElement('text', 'domanda', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 100))
            ),
            'required'   => true,
        ));
        $this->addElement('text', 'risposta', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 100))
            ),
            'required'         => true,
        ));
        $this->addElement('submit', 'Modifica', array(
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

