<?php

class Application_Form_Nuovopdf extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');
        $this->setName('gestioneedificio');
        $this->setAttrib('enctype', 'multipart/form-data');
        $this->setAction(''); // definirò l'azione nel controller quando istanzio la form


        $this->addElement('text','nomePdf', array(
            'required'  => true,
            'label'     => 'Nome',

        ));

        $this->addElement('file', 'pianta', array(
            'required'=> true,
            'label' => 'Pianta',
            'destination' => APPLICATION_PATH.'/../public/image/piante/piani di fuga/',
            'validators' => array(
                array('Count', false, 1),
                array('Size', false, 30960000),
                array('Extension', false, array('jpg','png'))
            )
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

