<?php

class Application_Form_Selezionastanza extends Zend_Form
{

    protected $_posizioniModel;
    protected $_numstanze;

    /**
     * costruttore dell classe
     * Application_Form_Selezionastanza constructor.
     * @param mixed|null $numStanze
     */
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

        //ciclo che crea un array di interi;
        // da 1 al numero di stanze del piano selezionato
        $cont=0;
        while($cont<$this->_numstanze) {
            $cont++;
            $stanze[$cont] = 'stanza ' . $cont;
        }

        //aggiunge un elemento select in cui il primo indice è disabilitato e il resto è un array
        // di stanze relative al piano selezionato
        $this->addElement('select', 'elencostanze', array(
            'required' => true,
            'value'=>0,
            'multiOptions' => $stanze,
            'disable'=>array(0),
        ));

        //aggiunge un elemento bottone
        $this->addElement("submit","Posizionati",array(
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

