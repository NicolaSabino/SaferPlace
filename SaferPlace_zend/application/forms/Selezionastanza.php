<?php

class Application_Form_Selezionastanza extends Zend_Form
{

    protected $_posizioniModel;

    public function init()
    {
        $this->setMethod('post');
        $this->setName('elencostanze'); //setta name e id del form
        $stanze = array(); //dichiaro un array che conterrà le opzioni della select
        $this->_posizioniModel = new Application_Resource_Posizioni(); //creo un istanza del model centro.
        $stanze[0]='Seleziona una stanza';
        
        $cont=0;
        while($cont<19) {
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
        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table', 'class' => 'zend_form')),
            array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
        ));
    }

    
}

