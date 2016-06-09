<?php

class App_Validate_ValidatoreZona extends Zend_Validate_Abstract
{
    const errore=null;

    protected $_messageTemplates = array(
        self::errore => "Le zone devono essere del tipo [A-Z], separate da uno spazio e lunghe massimo un carattere"
    );

    public function isValid($value)
    {
        $this->_setValue($value);
        $controllo=str_replace(" ", "", $value);
        $n=strlen($controllo)-1;
        if (!mb_ereg_match('([A-Z][[:space:]]){'.$n.'}[A-Z]',$value)) {
            $this->_error(self::errore);
            return false;
        }

        return true;
    }
}