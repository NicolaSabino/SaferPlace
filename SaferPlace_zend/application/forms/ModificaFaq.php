<?php

class Application_Form_ModificaFaq extends Zend_Form
{

    //attributi
    protected $_domanda;
    protected $_risposta;
    protected $_id;


    public function __construct($domanda = null ,$risposta=null,$id=null)
    {
        $this->_domanda = $domanda;
        $this->_risposta = $risposta;
        $this->_id = $id;
        $this->init();
    }

    public function init()
    {
        $this->setMethod('post');
        $this->setName('modificaFaq'); //setta name e id del form
        $this->addElement('text','id',array(
            'class'     => 'hide',
            'required'  => true,
            'value'     => $this->_id
        ));
        $this->addElement('text', 'domanda', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 100))
            ),
            'required'   => true,
            'label'      => 'Domanda',
            'value'      => $this->_domanda

        ));
        $this->addElement('text', 'risposta', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 100))
            ),
            'required'         => true,
            'label'      => 'Risposta',
            'value'      => $this->_risposta
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


    /**
     * Metodo per popolare la form
     * @param array $data
     * @return $this
     */
    public function populate($domanda,$risposta)
    {
            $this->domanda->setValue($domanda);
            $this->risposta->setValue($risposta);
    }

}

