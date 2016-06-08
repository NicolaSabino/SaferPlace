<?php

class Application_Form_Gestioneedificio extends Zend_Form
{


    public function init()
    {
        $this->setMethod('post');
        $this->setName('gestioneedificio');
        $this->setAttrib('enctype', 'multipart/form-data');
        $this->setAction(''); // definirò l'azione nel controller quando istanzio la form
        

        $this->addElement('text','nome', array(
            'required'  => true,
            'value'     => $this->_nome,
            'label'     => 'Nome Edificio'

        ));
        
        $this->addElement('text', 'informazioni', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 2500))
            ),
            'cols' => '60', 'rows' => '40',
            'required'   => true,
            'label'      => 'Informazioni',
            'value'      => $this->_informazioni,
            'class'      => 'black-text'

        ));



        $this->addElement('file', 'mappa', array(
            'label' => 'Immagine del prodotto',
            'required' =>false,
            'destination' => APPLICATION_PATH.'/../public/image/edifici/',
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

    public function populate($dati)
    {

        $this->nome->setValue($dati->current()->nome);
        $this->informazioni->setValue($dati->current()->informazioni);
        $this->mappa->setValue($dati->current()->mappa);



    }


}

