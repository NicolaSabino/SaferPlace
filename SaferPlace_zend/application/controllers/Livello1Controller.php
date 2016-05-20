<?php

class Livello1Controller extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    }

    public function controllaEdificio()
    {
        $edificio=0;
        if($this->hasParam("edificio"))
            $edificio=$this->getParam("edificio");
        return $edificio;
    }

    public function checkinAction()
    {
        $edificimodel=new Application_Resource_Edifici();
        $this->view->u = $edificimodel->getEdifici()->toArray();
    }

    public function checkinbAction()
    {
        $piano=$this->controllaEdificio();
        $pianimodel=new Application_Resource_Piani();
        $this->view->u = $pianimodel->getPianiByEdificio($piano)->toArray();
        
        $edificio=$this->controllaEdificio();
        $edificimodel=new Application_Resource_Edifici();
        $this->view->v = $edificimodel->getEdifici($edificio)->toArray();
    }


}









