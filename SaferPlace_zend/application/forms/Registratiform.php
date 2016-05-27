<?php

class Application_Form_Registratiform extends Zend_Form
{

    //attributi
        protected $_nome        = null;
        protected $_congome     = null;
        protected $_genere       = null;
        protected $_eta         = null;
        protected $_telefono    = null;
        protected $_username    = null;
        protected $_password    = null;
        protected $_email       = null;


    /**
     * Application_Form_Registratiform constructor.
     *
     * Popolo la form tramite questo array associativo
     *
     * Nel caso di una form vuota il valore di default dell'array è NULL
     *
     * @param null $array
     */
    public function __construct($array = null
    )
    {
        $this->_nome        =$array['nome'];
        $this->_congome     =$array['cognome'];
        $this->_genere      =$array['genere'];
        $this->_eta         =$array['eta'];
        $this->_telefono    =$array['telefono'];
        $this->_username    =$array['username'];
        $this->_email       =$array['email'];
        
        $this->init();
        
    }
    
    
    public function init()
    {
        $this->setMethod('post');
        $this->setName('registratiform'); //setta name e id del form


        
        $this->addElement('text', 'Nome', array(
            'filters'       => array('StringTrim'),
            'required'      => true,
            'label'         => 'Nome',
            'class'         =>'black-text',
            'value'         => $this->_nome


        ));
        $this->addElement('text', 'Cognome', array(
            'filters'       => array('StringTrim'),
            'required'      => true,
            'label'         => 'Cognome',
            'class'         =>'black-text',
            'value'         => $this->_congome


        ));

        $this->addElement('select', 'genere', array(
            'label'         => 'Genere',
            'filters'       => array('StringTrim'),
            'required'      => true,
            'multiOptions'  => array('m'=>'Uomo','f'=>'Donna'),
            'class'         =>'black-text',
            'value'         => $this->_genere

        ));

        $this->addElement('text', 'eta', array(
            'filters'           => array('StringTrim'),
            'validators'        => array(
                array('StringLength', true, array(0, 3))
            ),
            'required'          => true,
            'label'             => 'Età',
            'class'             =>'black-text',
            'value'             =>$this->_eta


        ));

        $this->addElement('text', 'telefono', array(
            'filters'       => array('StringTrim'),
            'validators'    => array(
                array('StringLength', true, array(10, 10))
            ),
            'required'      => true,
            'label'         => 'Telefono',
            'class'         =>'black-text',
            'value'         => $this->_telefono


        ));


        $this->addElement('text', 'username', array(
            'filters'       => array('StringTrim'),
            'validators'    => array(
                array('StringLength', true, array(2, 64))
            ),
            'required'      => true,
            'label'         => 'Username',
            'class'         =>'black-text',
            'value'         => $this->_username
        ));

        $this->addElement('password', 'password', array(
            'filters'       => array('StringTrim'),
            'validators'    => array(
                array('StringLength', true, array(2, 64))
            ),
            'required'      => true,
            'label'         => 'Password',
            'class'         =>'black-text',
            'placeholder'   => 'Inserisci la password'
            


        ));

        $this->addElement('text', 'email', array(
            'filters'       => array('StringTrim'),
            'required'      => true,
            'label'         => 'Email',
            'class'         =>'black-text',
            'validators'    => array(
                Zend_Validate_EmailAddress::INVALID => 'EmailAddress',
            ),
            'value'         => $this->_email
        ));

        $this->addElement('submit', 'ok', array(
            'class'         => 'btn waves-yellow green',
        ));

        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'a', 'class' => 'zend_form')),
            array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
        ));
    }
}