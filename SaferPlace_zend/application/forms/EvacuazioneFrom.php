<?php

class Application_Form_Segnalaform extends Zend_Form
{

    protected $_utenteModel;
    protected $_numstanze;

    /**
     * costruttore dell classe
     * Application_Form_Selezionastanza constructor.
     * @param mixed|null $numStanze
     */
    public function __construct($numStanze)
    {
        $this->_numstanze = $numStanze;
        $this->init();
    }


    public function init()
    {

        $this->setMethod('post');
        $this->setName('Evacuazione');
        $this->_utenteModel = new Application_Model_UtenteStaff();
        $edifici[0] = 'Seleziona edificio'; // array che conterrà le opzioni della select
        $piani[0] = 'Seleziona piano'; // array che contiene i piani, per ora lo definisco manualmente in attesa di ajax
        $piani[1] = 'Piano 1';
        $piani[2] = 'Piano 2';
        $piani[3] = 'Piano 3';

        $edgest = $this->_utenteModel->getEdificiGestiti(); // edifici gestiti dal membro staff
        foreach ($edgest as $nome => $piano)
            array_push($edifici, $nome);

        $this->addElement('select', 'scegliedificio', array(
            'required' => true,
            'value'=>0,
            'multiOptions' => $edifici,
            'disable'=>array(0),
        ));

        $this->addElement('select', 'sceglistanza', array(
            'required' => true,
            'value'=>0,
            'multiOptions' => $piani,
            'disable'=>array(0),
        ));

        $this->addElement("submit","Segnala",array(
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

}