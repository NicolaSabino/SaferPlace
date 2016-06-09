<?php

class Application_Model_UtenteStaff extends App_Model_Abstract
{
    protected $_nomeUtente;
    
    public function __construct($user){
        $this->_nomeUtente=$user;
    }
    
    //restituisce l'insieme degli edifici gestiti da un determinato utente e i relativi piani in un array
    // associativo di array, del tipo [edificio][arraypiani]
    public function getEdificiGestiti(){
        
       
        $pianiModel             = new Application_Model_Piani();
        $edifici_e_piani        = array();

        //estraggo gli edifici
        $arrayEdifici = $this->getResource('Edifici')->getGestByUtente($this->_nomeUtente);


        //creo un array di array associativi per contenere linsieme di edifici e i relativi piani
        foreach ($arrayEdifici as $edificio) {

            //salvo il nome dell'edificio considerato
            $nomeEdificio = $edificio->edificio;

            //estraggo i piani dell'edificio considerato
            $piani = $pianiModel->getPianiByEdificio($nomeEdificio);

            //per ogni piano ne salvo il nome
            foreach ($piani as $item) {

                $var = $item->numeroPiano;
                //creo il vettore multidimensionale contenente il risultato
                $edifici_e_piani[$nomeEdificio][] = $var;

            }
        }
        return $edifici_e_piani;

    }

    public function getNotificheEmergenze(){

        $ed= new Application_Resource_Edifici();
        $edificigest = $ed->getGestByUtente($this->_nomeUtente);
        $notifica = new Application_Resource_Notifica();


        foreach ($edificigest as $item) {
            $queryArray[] = $notifica->getAllByEd($item->edificio);

        }
        // crea la query union per avere tutte le notifiche di tutti gli edifici gestiti in un unico rowset
        $allnotif = $notifica->select()->union($queryArray)->order('id DESC');
      
        return $notifica->fetchAll($allnotif);
    }

    public function getPlanimetria($edificio,$numeropiano){

        $pianta = new Application_Resource_Piani();

        return $pianta->getPianta($edificio, $numeropiano);
    }

    public function deleteNotification($id){

        $notifica = new Application_Resource_Notifica();

        return $notifica->deleteOne($id);
    }

    public function fetchEventi() {

        $edificigest = $this->getResource('Edifici')->getGestByUtente($this->_nomeUtente);
        $eventi = new Application_Resource_Eventi();


        foreach ($edificigest as $item) {
            $queryArray[] = $eventi->getAllByEd($item->edificio);

        }
        // crea la query union per avere tutte le notifiche di tutti gli edifici gestiti in un unico rowset
        $allevents = $eventi->select()->union($queryArray);

        return $eventi->fetchAll($allevents);
    }


    public function addEvento($nome,$idSegnalazione, $idpiano){

        $evento = new Application_Resource_Eventi();

        return (bool) $evento->addEvento($nome,$idSegnalazione, $idpiano);
    }

    public function delEvento($id) {

        $evento = new Application_Resource_Eventi();

        return $evento->deleteOne($id);
    }

    public function delAllEventi() {


        $edificigest = $this->getResource('Edifici')->getGestByUtente($this->_nomeUtente);
        $eventi = new Application_Resource_Eventi();


        foreach ($edificigest as $item) {
            $queryArray[] = $eventi->getAllByEd($item->edificio);

        }
        // crea la query union per avere tutti gli eventi di tutti gli edifici gestiti in un unico rowset
        $eventsquery = $eventi->select()->union($queryArray);
        $allevents = $eventi->fetchAll($eventsquery);
        foreach ($allevents as $item)
            $this->delEvento($item->id);

        return;
    }

    public function getPersEdificio($edificio) {

        $collocazioni = new Application_Resource_Collocazioni();
        $query= $collocazioni->getNumCollocazioniByEdificio($edificio);

        return $collocazioni->fetchAll($query)->current();
    }

    public function getPersPiano($edificio, $piano){

        return $this->getResource('Collocazioni')->getNumByPiano($edificio,$piano);
    }

    public function getNumPersStanze($edificio,$numPiano) {

        return $this->getResource('Collocazioni')->getNumPerStanza($edificio,$numPiano);
    }

    public function getPersEdGest ($edifici) {

        $persedificigestiti = array();
        foreach ($edifici as $edif => $item)
            array_push($persedificigestiti, $this->getPersEdificio($edif)->numPersone);

        return $persedificigestiti;
    }
    
    //restituisce tutti i piani di fuga relativi a un piano di un edificio
    public function getPianiFuga($edificio,$piano) {
        $zonaResource = new Application_Resource_Zona();
        $assegnazioniResource = new Application_Resource_Assegnazione();
        $zone= $this->getResource('Zona')->getZoneByEdPiano($edificio,$piano);

        foreach ($zone as $item)
            $queryArray[] = $assegnazioniResource->getAssegnazioniByZonaStaff($item->id);

        $allpianidifuga = $assegnazioniResource->select()->union($queryArray);
        
        return $assegnazioniResource->fetchAll($allpianidifuga);
    }
    
    //restituisce le zone relative a un piano di un edificio
    public function getZone($edificio, $piano) {
        
        return $this->getResource('Zona')->getZoneByEdPiano($edificio,$piano);
    }
    
    public function avviaEvac($edificio,$tipo,$idSegnalazione, $piano, $zona, $idPianoFuga) {

        $idpiano = $this->getResource('Piani')->getIdPiano($edificio,$piano);
        $this->getResource('Eventi')->addEvento($tipo,$idSegnalazione, $idpiano[0]->id, $zona);

        $zone = $this->getResource('Zona')->getZoneByEdPiano($edificio,$piano);
        foreach ($zone as $item) {
            $this->getResource('Assegnazione')->disabilitaPianoFuga($item->id);
        }

        
        $this->getResource('Assegnazione')->abilitaPianoFuga($idPianoFuga);

        return;
    }

    /**
     * @return mixed
     */
    public function pianiEdToArray($edificio)
    {
        $dbpiani=$this->getResource('Piani')->getPianiByEdificio($edificio);
        
        $opzioni = $this->toXXArray($dbpiani, 'numeroPiano');
        
        return $opzioni;
    }

    public function zonePianoToArray($edificio,$piano) {
        
        $zone = $this->getResource('Zona')->getZoneByEdPiano($edificio,$piano);
        $opzioni = $this->toXXArray($zone, 'alias');
        
        return $opzioni;
    }
    
    /* prende un rowset e un campo della tabella da cui è stato estratto il rowset
       per restituire un array associativo del tipo X => X */
    protected function toXXArray($data, $field){

        foreach ($data as $item){

            $array[$item->$field] = $item->$field;
        }
        
        return $array;
    }


    public function getSegnalazioniStanze($edificio,$piano){

       return $this->getResource('Notifica')->getNumPerStanza($edificio, $piano);
        
    }
}