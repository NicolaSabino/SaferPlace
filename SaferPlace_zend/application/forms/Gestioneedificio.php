<?php

class Application_Form_Gestioneedificio extends Zend_Form
{


    //attributi
    protected $_nome;
    protected $_informazioni;
    protected $_immagine;

    public function __construct($nome = null ,$informazioni=null)
    {
        //assegno le variabili
        $this->_nome = $nome;
        $this->_informazioni = $informazioni;

        $this->init();
    }

    public function init()
    {
        $this->setMethod('post');
        $this->setName('gestioneedificio');
        $this->setAttrib('enctype', 'multipart/form-data');
        $this->setAction(''); // definirò l'azione nel controller quando istanzio la form
        

        $this->addElement('text','Nome', array(
            'required'  => true,
            'value'     => $this->_nome,
            'label'     => 'Nome Edificio'

        ));
        $this->addElement('text', 'Informazioni', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 100))
            ),
            'required'   => true,
            'label'      => 'Informazioni',
            'value'      => $this->_informazioni,
            'class'      => 'black-text'

        ));

        $this->addElement('file', 'img_path', array(
            'label' => 'Immagine del prodotto',
            'required' =>false,
            'destination' => APPLICATION_PATH.'/../public/image/edifici/',
            'validators' => array(
                array('Count', false, 1),
                array('Size', false, 3096000),
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

