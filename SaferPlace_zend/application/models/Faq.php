<?php

class Application_Model_Faq extends App_Model_Abstract
{
    /**
     * Prelevo l'insieme di faq dal db
     *
     * @return mixed
     */
    public function getFaqSet(){
        return $this->getResource('Faq')->getAll();

    }

    /**
     * Aggiorno le informazioni di una faq
     *
     * @param $domanda
     * @param $risposta
     * @param $id
     */
    public function setfaq($domanda,$risposta,$id){
        $this->getResource('Faq')->setFaq($domanda,$risposta,$id);
    }
    
    public function newFaq($domanda,$risposta){
        $this->getResource('Faq')->insertFaq($domanda,$risposta);
    }
    
    public function deleteFaq($id){
        $this->getResource('Faq')->delFaq($id);
    }
}

    