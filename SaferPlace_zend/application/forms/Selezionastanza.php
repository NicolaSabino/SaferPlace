<?php

class Application_Form_Selezionastanza extends Zend_Form
{

    protected $_posizioniModel;
    protected $_numstanze;

    
    public function __construct($numStanze)
    {
       $this->_numstanze=$numStanze;
        $this->init();
    }


    public function init()
    {
        $this->setMethod('post');
        $this->setName('elencostanze'); //setta name e id del form
        $stanze = array(); //dichiaro un array che conterrà le opzioni della select
        $this->_posizioniModel = new Application_Resource_Posizioni(); //creo un istanza del model centro.
        $stanze[0]='Seleziona una stanza';
        
        $cont=0;
        while($cont<$this->_numstanze) {
            $cont++;
            $stanze[$cont] = 'stanza ' . $cont;
        }

        $this->addElement('select', 'elencostanze', array(
            'required' => true,
            'value'=>0,
            'multiOptions' => $stanze,
            'disable'=>array(0),
            'class' => 'form-control'

        ));
        $this->addElement("submit","Posizionati",array(
            "class" => "green btn center",
        ));
        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table', 'class' => 'zend_form')),
            array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
        ));
    }

    
}

