<?php

class Application_Form_Selezionapiano extends Zend_Form
{

    protected $_pianiModel;
    public function init()
    {
        $this->setMethod('post');
        $this->setName('elencopiani'); //setta name e id del form
        $piani = array(); //dichiaro un array che conterrà le opzioni della select
        $this->_pianiModel = new Application_Resource_Piani(); //creo un istanza del model centro.
        $piano= $this->_pianiModel->getPianiByEdificio('Liceo Classico')->toArray(); //creo un array chiamato piano che conterrà tutti i dati dei piani
        $piani[0]='Seleziona un piano';
        foreach ($piano as $p) {
            $piani[] = 'Piano '.$p['numeroPiano'];
        }
        $this->addElement('select', 'elencopiani', array(
            'required' => true,
            'value'=>0,
            'multiOptions' => $piani,
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



