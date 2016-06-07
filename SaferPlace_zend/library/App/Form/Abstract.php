<?php
class App_Form_Abstract extends Zend_Form
{
	public $elementDecorators = array(
        'ViewHelper',
        array(array('alias1' => 'HtmlTag'),array('tag' => 'td', 'class' => 'element')),
		array(array('alias2' => 'HtmlTag'), array('tag' => 'td', 'class' => 'errors','openOnly' => true, 'placement' => 'append')),
		'Errors',
		array(array('alias3' => 'HtmlTag'), array('tag' => 'td', 'closeOnly' => true, 'placement' => 'append')),
        array('Label', array('tag' => 'td')),
        array(array('alias4' => 'HtmlTag'), array('tag' => 'tr')),
        );
    
	public $buttonDecorators = array(
        'ViewHelper',
        array(array('alias1' => 'HtmlTag'), array('tag' => 'td', 'class' => 'button')),
        array(array('alias2' => 'HtmlTag'), array('tag' => 'tr')),
    	);
    
	public $fileDecorators = array(
        'File',
        array(array('alias1' => 'HtmlTag'),array('tag' => 'td', 'class' => 'file')),
		array(array('alias2' => 'HtmlTag'), array('tag' => 'td', 'class' => 'errors', 'openOnly' => true, 'placement' => 'append')),
		'Errors',
		array(array('alias3' => 'HtmlTag'), array('tag' => 'td', 'closeOnly' => true, 'placement' => 'append')),
        array('Label', array('tag' => 'td')),
        array(array('alias4' => 'HtmlTag'), array('tag' => 'tr')),
        );
}