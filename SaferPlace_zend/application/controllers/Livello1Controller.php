<?php

class Livello1Controller extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $edificio=$this->controllaEdificio();
        echo  $edificio;
        if ($this->hasParam("zona"))
            $zona=$this->getParam("zona");
        if ($this->hasParam("stanza"))
            $stanza=$this->getParam("stanza");
        if ($this->hasParam("idPiano"))
        $idPiano=$this->getParam("idPiano");
        $this->model->u=array("edificio"=>$edificio,"zona"=>$zona,"stanza"=>$stanza,"idPiano"=>$idPiano);
        //if($edificio==0)
            //$this->_redirect('/livello1/checkin');
        //else{
        //}


    }

    public function checkinAction()
    {
        $edificimodel=new Application_Model_Edifici();
        $this->view->u = $edificimodel->getEdifici()->toArray();
    }

    public function checkinbAction()
    {
        $edificio=$this->controllaEdificio();
        $pianimodel=new Application_Model_Piani();
        $this->view->u = $pianimodel->getPianiByEdificio($edificio)->toArray();
    }

    public function controllaEdificio(){
        $edificio=0;
        if($this->hasParam("edificio"))
            $edificio=$this->getParam("edificio");
        return $edificio;
    }


}





