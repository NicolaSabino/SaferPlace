<?php

class Application_Form_Registratiform extends App_Form_Abstract
{
    protected $_nome;
    protected $_cognome;
    protected $_username;
    protected $_genere;
    protected $_eta;
    protected $_telefono;
    protected $_password;
    protected $_email;
    



    public function init()
    {
        $this->setMethod('post');
        $this->setName('registratiform'); //setta name e id del form


        
        $this->addElement('text', 'Nome', array(
            'filters'    => array('StringTrim'),
            'required'   => true,
            'label'=> 'Nome',
            'class' =>'black-text',
            'value'=>$this->_nome,


        ));

        $this->addElement('text', 'Cognome', array(
            'filters'    => array('StringTrim'),
            'required'   => true,
            'label'=> 'Cognome',
            'class' =>'black-text',
            'value'=>$this->_cognome,



        ));

        $this->addElement('select', 'genere', array(
            'label' => 'Genere',
            'filters'    => array('StringTrim'),
            'required'   => true,
            'multiOptions' => array('m'=>'Uomo','f'=>'Donna'),
            'class' =>'black-text',
            'value'=>$this->_genere,


        ));

        $this->addElement('text', 'eta', array(
            'filters'    => array('StringTrim'),
            'validators' => array(array('Digits'),
                array('StringLength', true, array(0, 3))
            ),
            'required'         => true,
            'label'      => 'Età',
            'class' =>'black-text',
            'value'=>$this->_eta,



        ));

        $this->addElement('text', 'telefono', array(
            'filters'    => array('StringTrim'),
            'validators' => array(array('Digits'),
                array('StringLength', true, array(10, 10))
            ),
            'required'         => true,
            'label'      => 'Telefono',
            'class' =>'black-text',
            'value'=>$this->_telefono,



        ));


        $this->addElement('text', 'username', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(2, 64))
            ),
            'required'         => true,
            'label'      => 'Username',
            'class' =>'black-text',
            'value'=>$this->_username,

        ));

        $this->addElement('password', 'password', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(2, 64))
            ),
            'required'         => true,
            'placeholder' => 'Inserisci la password',
            'label'      => 'Password',
            'class' =>'black-text',
            'value'=>$this->_password,
        ));

        $this->addElement('text', 'email', array(
            'filters'    => array('StringTrim'),
            'required'         => true,
            'label'      => 'Email',
            'class' =>'black-text',
            'validators' => array(Zend_Validate_EmailAddress::INVALID => 'EmailAddress',),
            'value'=>$this->_email,
        ));

        $this->addElement('submit', 'ok', array(
            'class' => 'btn waves-yellow green',
        ));

        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'a', 'class' => 'zend_form')),
            array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
        ));

        include_once ('Lingua.php');
    }


    /**
     * Metodo per popolare la form
     * @param array $data
     * @return $this
     */
    public function populate($dati)
    {
        $this->Nome->setValue($dati->current()->nome);
        $this->Cognome->setValue($dati->current()->cognome);
        $this->username->setValue($dati->current()->username);
        $this->genere->setValue($dati->current()->genere);
        $this->eta->setValue($dati->current()->eta);
        $this->telefono->setValue($dati->current()->telefono);        
        $this->password->renderPassword = true;
        $this->password->setValue($dati->current()->password);
        $this->email->setValue($dati->current()->email);

    }
}