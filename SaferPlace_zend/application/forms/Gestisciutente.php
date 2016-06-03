<?php

class Application_Form_Gestisciutente extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');
        $this->setName('registratiform'); //setta name e id del form



        $this->addElement('text', 'nome', array(
            'filters'       => array('StringTrim'),
            'required'      => true,
            'label'         => 'Nome',
            'class'         =>'black-text',
            'value'         => $this->_nome


        ));
        $this->addElement('text', 'cognome', array(
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
            'class'             => 'black-text',
            'value'             =>  $this->_eta


        ));

        $this->addElement('text', 'telefono', array(
            'filters'       => array('StringTrim'),
            'validators'    => array(
                array('StringLength', true, array(10, 10))
            ),
            'required'      => true,
            'label'         => 'Telefono',
            'class'         => 'black-text',
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
            'class'         => 'black-text',
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

        $this->addElement('select', 'livello', array(
            'label'         => 'Livello',
            'filters'       => array('StringTrim'),
            'required'      => true,
            'multiOptions'  => array('0'=>'Utente Semplice','1'=>'Staff'),
            'class'         =>'black-text',
            'value'         => $this->_livello

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

    /**
     * Metodo per popolare la form
     * @param array $data
     * @return $this
     */
    public function populate($dati)
    {
        $this->Nome->setValue($dati['nome']);
        $this->Cognome->setValue($dati['cognome']);
        $this->username->setValue($dati['username']);
        $this->genere->setValue($dati['genere']);
        $this->eta->setValue($dati['eta']);
        $this->telefono->setValue($dati['telefono']);
        $this->password->renderPassword = true;
        $this->password->setValue($dati['password']);
        $this->email->setValue($dati['email']);

    }


}

