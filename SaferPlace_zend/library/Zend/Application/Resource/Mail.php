<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Application
 * @subpackage Resource
<<<<<<< HEAD
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
=======
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: Mail.php 24593 2012-01-05 20:35:02Z matthew $
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
 */

/**
 * @see Zend_Application_Resource_ResourceAbstract
 */
require_once 'Zend/Application/Resource/ResourceAbstract.php';

/**
 * Resource for setting up Mail Transport and default From & ReplyTo addresses
 *
 * @uses       Zend_Application_Resource_ResourceAbstract
 * @category   Zend
 * @package    Zend_Application
 * @subpackage Resource
<<<<<<< HEAD
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
=======
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Application_Resource_Mail extends Zend_Application_Resource_ResourceAbstract
{

    /**
     * @var Zend_Mail_Transport_Abstract
     */
    protected $_transport;

<<<<<<< HEAD
    public function init()
    {
=======
    public function init() {
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
        return $this->getMail();
    }

    /**
     *
     * @return Zend_Mail_Transport_Abstract|null
     */
    public function getMail()
    {
        if (null === $this->_transport) {
            $options = $this->getOptions();
<<<<<<< HEAD
            foreach ($options as $key => $option) {
=======
            foreach($options as $key => $option) {
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
                $options[strtolower($key)] = $option;
            }
            $this->setOptions($options);

<<<<<<< HEAD
            if (isset($options['transport'])
                && !is_numeric($options['transport'])
            ) {
                $this->_transport = $this->_setupTransport($options['transport']);
                if (!isset($options['transport']['register'])
                    || $options['transport']['register'] == '1'
                    || (isset($options['transport']['register'])
                        && !is_numeric($options['transport']['register'])
                        && (bool)$options['transport']['register'] == true)
                ) {
=======
            if(isset($options['transport']) &&
               !is_numeric($options['transport']))
            {
                $this->_transport = $this->_setupTransport($options['transport']);
                if(!isset($options['transport']['register']) ||
                   $options['transport']['register'] == '1' ||
                   (isset($options['transport']['register']) &&
                        !is_numeric($options['transport']['register']) &&
                        (bool) $options['transport']['register'] == true))
                {
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
                    Zend_Mail::setDefaultTransport($this->_transport);
                }
            }

            $this->_setDefaults('from');
            $this->_setDefaults('replyTo');
        }

        return $this->_transport;
    }

<<<<<<< HEAD
    protected function _setDefaults($type)
    {
        $key = strtolower('default' . $type);
        $options = $this->getOptions();

        if (isset($options[$key]['email'])
            && !is_numeric($options[$key]['email'])
        ) {
            $method = array('Zend_Mail', 'setDefault' . ucfirst($type));
            if (isset($options[$key]['name'])
                && !is_numeric(
                    $options[$key]['name']
                )
            ) {
                call_user_func(
                    $method, $options[$key]['email'], $options[$key]['name']
                );
=======
    protected function _setDefaults($type) {
        $key = strtolower('default' . $type);
        $options = $this->getOptions();

        if(isset($options[$key]['email']) &&
           !is_numeric($options[$key]['email']))
        {
            $method = array('Zend_Mail', 'setDefault' . ucfirst($type));
            if(isset($options[$key]['name']) &&
               !is_numeric($options[$key]['name']))
            {
                call_user_func($method, $options[$key]['email'],
                                        $options[$key]['name']);
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
            } else {
                call_user_func($method, $options[$key]['email']);
            }
        }
    }

    protected function _setupTransport($options)
    {
<<<<<<< HEAD
        if (!isset($options['type'])) {
            $options['type'] = 'sendmail';
        }

        $transportName = $options['type'];
        if (!Zend_Loader_Autoloader::autoload($transportName)) {
            $transportName = ucfirst(strtolower($transportName));

            if (!Zend_Loader_Autoloader::autoload($transportName)) {
                $transportName = 'Zend_Mail_Transport_' . $transportName;
                if (!Zend_Loader_Autoloader::autoload($transportName)) {
=======
        if(!isset($options['type'])) {
            $options['type'] = 'sendmail';
        }
        
        $transportName = $options['type'];
        if(!Zend_Loader_Autoloader::autoload($transportName))
        {
            $transportName = ucfirst(strtolower($transportName));

            if(!Zend_Loader_Autoloader::autoload($transportName))
            {
                $transportName = 'Zend_Mail_Transport_' . $transportName;
                if(!Zend_Loader_Autoloader::autoload($transportName)) {
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
                    throw new Zend_Application_Resource_Exception(
                        "Specified Mail Transport '{$transportName}'"
                        . 'could not be found'
                    );
                }
            }
        }

        unset($options['type']);
        unset($options['register']); //@see ZF-11022

        switch($transportName) {
            case 'Zend_Mail_Transport_Smtp':
<<<<<<< HEAD
                if (!isset($options['host'])) {
                    throw new Zend_Application_Resource_Exception(
                        'A host is necessary for smtp transport,'
                        . ' but none was given'
                    );
=======
                if(!isset($options['host'])) {
                    throw new Zend_Application_Resource_Exception(
                        'A host is necessary for smtp transport,'
                        .' but none was given');
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
                }

                $transport = new $transportName($options['host'], $options);
                break;
            case 'Zend_Mail_Transport_Sendmail':
            default:
                $transport = new $transportName($options);
                break;
        }

        return $transport;
    }
}
