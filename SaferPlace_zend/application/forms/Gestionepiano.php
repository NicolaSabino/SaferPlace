<?php

class Application_Form_Gestionepiano extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');
        $this->setName('gestioneedificio');
        $this->setAttrib('enctype', 'multipart/form-data');
        $this->setAction(''); // definirò l'azione nel controller quando istanzio la form
        

        $this->addElement('text','numeroPiano', array(
            'required'  => true,
            'label'     => 'Numero Piano',
            'validators' => array(array('Digits'))

        ));


        $this->addElement('text','nstanze', array(
            'required'  => true,
            'label'     => 'Numero delle stanze',
            'validators' => array(array('Digits'))


        ));

        $this->addElement('file', 'pianta', array(
            'label' => 'Pianta',
            'destination' => APPLICATION_PATH.'/../public/image/piante/',
            'validators' => array(
                array('Count', false, 1),
                array('Size', false, 30960000),
                array('Extension', false, array('jpg','png'))
            )
        ));

        /*$this->addElement('file', 'mappa', array(
            'label' => 'Mappa della pianta',
            'destination' => APPLICATION_PATH.'/../public/image/piante/map/',
            'validators' => array(
                array('Count', false, 1),
                array('Size', false, 30960000),
                array('Extension', false, array('txt'))
            )
        ));*/


        $this->addElement('submit', 'ok', array(
            'class' => 'btn btn-large green white-text'
        ));

        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'a', 'class' => 'zend_form')),
            array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
        ));
    }

    public function populate($data)
    {
        $this->numeroPiano->setValue($data->current()->numeroPiano);
        $this->nstanze->setValue($data->current()->nstanze);
        $this->pianta->setValue($data->current()->pianta);
        //$this->mappa->setValue($data->current()->mappa);
    }



}

