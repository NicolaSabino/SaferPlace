<?php
class Application_Resource_Segnalazioni extends  Zend_Db_Table_Abstract
{
    protected  $_name='segnalazione';
    protected $_rowClass='Application_Resource_Segnalazioni_Item';


    public function insertSegnalazione($user, $idPosizione, $tipo){

        $segnalazioni = array(
            'utente'      => $user,
            'idPosizione' => $idPosizione,
            'tipo' => $tipo,
        );

        $this->insert($segnalazioni);

    }

}