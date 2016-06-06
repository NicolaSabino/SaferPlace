<?php

class Application_Form_Evacuazioneform extends Zend_Form
{

    protected $_utenteModel;
    protected $_numstanze;

    /**
     * costruttore dell classe
     * Application_Form_Selezionastanza constructor.
     * @param mixed|null $numStanze
     */
    public function __construct($user,$edificio,$piano,$tipo)
    {
        $this->_utenteModel = new Application_Model_UtenteStaff($user);
        $this->init();
    }


    public function init()
    {

        $this->setMethod('post');
        $this->setName('Evacuazione');
        $this->_utenteModel = new Application_Model_UtenteStaff();

        $tipo['default'] = 'Seleziona tipo emergenza';
        $tipo['Incendio'] = 'Incendio';
        $tipo['Crollo'] = 'Crollo';
        $tipo['Fuga di gas'] = 'Fuga di gas';
        $tipo['Allagamento'] = 'Allagamento';
        $edifici['default'] = 'Seleziona edificio'; // array che conterrà le opzioni della select
        $piani[0] = 'Seleziona piano'; // array che contiene i piani, per ora lo definisco manualmente in attesa di ajax
        $piani[1] = 'Piano 1';
        $piani[2] = 'Piano 2';
        $piani[3] = 'Piano 3';
        $zone[0] = 'Seleziona la zona dell\'emergenza';
        $zone['A'] = 'A';
        $zone['B'] = 'B';
        $zone['C'] = 'C';

        $edgest = $this->_utenteModel->getEdificiGestiti(); // edifici gestiti dal membro staff
        foreach ($edgest as $nome => $piano)
            $edifici[$nome] = $nome;

        $this->addElement('select', 'tipo', array(
            'required' => true,
            'value' => 'default',
            'multioptions' => $tipo,
            'disable' => array('default'),
        ));

        $this->addElement('select', 'edificio', array(
            'required' => true,
            'value' => 'default',
            'multioptions' => $edifici,
            'disable' => array('default'),
        ));

        $this->addElement('select', 'piano', array(
            'required' => true,
            'value' => 0,
            'multiOptions' => $piani,
            'disable' => array(0),
        ));

        $this->addElement('select', 'zona', array(
            'required' => false,
            'value' => 0,
            'multiOptions' => $zone,
            'disable' => array('default'),
        ));

        $this->addElement("submit", "Conferma", array(
            "class" => "green btn center",
            'required' => true,

        ));


        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table', 'class' => 'zend_form')),
            array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
        ));


    }

    public function populate($edificio,$piano,$tipo)
    {
        $this->getElement('tipo')->setValue($tipo);
        $this->getElement('edificio')->setValue($edificio);
        $this->getElement('piano')->setValue($piano);
    }

}

