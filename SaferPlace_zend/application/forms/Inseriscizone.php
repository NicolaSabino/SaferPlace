<?php

class Application_Form_Inseriscizone extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');
        $this->setName('inseriscizone');
        $this->setAttrib('enctype', 'multipart/form-data');
        $this->setAction(''); // definirò l'azione nel controller quando istanzio la form


        $this->addElement('text','zone', array(
            'required'  => true,
            'label'     => 'Zone',
        ));
        

        $this->addElement('file', 'pianta', array(
            'label' => 'Pianta',
            'destination' => APPLICATION_PATH.'/../public/image/piante/zone',
            'validators' => array(
                array('Count', false, 1),
                array('Size', false, 30960000),
                array('Extension', false, array('jpg','png'))
            )
        ));

        $this->addElement('submit', 'ok', array(
            'class'         => 'btn waves-yellow green',
        ));

    }


}

