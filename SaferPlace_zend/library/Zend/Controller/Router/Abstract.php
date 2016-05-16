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
 * @package    Zend_Controller
 * @subpackage Router
<<<<<<< HEAD
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

=======
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: Abstract.php 24593 2012-01-05 20:35:02Z matthew $
 */


>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
/** Zend_Controller_Router_Interface */
require_once 'Zend/Controller/Router/Interface.php';

/**
 * Simple first implementation of a router, to be replaced
 * with rules-based URI processor.
 *
 * @category   Zend
 * @package    Zend_Controller
 * @subpackage Router
<<<<<<< HEAD
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
=======
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
abstract class Zend_Controller_Router_Abstract implements Zend_Controller_Router_Interface
{
    /**
     * URI delimiter
     */
    const URI_DELIMITER = '/';
<<<<<<< HEAD

    /**
     * Front controller instance
     *
=======
    
    /**
     * Front controller instance
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
     * @var Zend_Controller_Front
     */
    protected $_frontController;

    /**
     * Array of invocation parameters to use when instantiating action
     * controllers
<<<<<<< HEAD
     *
=======
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
     * @var array
     */
    protected $_invokeParams = array();

    /**
     * Constructor
     *
     * @param array $params
<<<<<<< HEAD
=======
     * @return void
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
     */
    public function __construct(array $params = array())
    {
        $this->setParams($params);
    }

    /**
     * Add or modify a parameter to use when instantiating an action controller
     *
     * @param string $name
<<<<<<< HEAD
     * @param mixed  $value
     * @return Zend_Controller_Router_Abstract
     */
    public function setParam($name, $value)
    {
        $name                       = (string)$name;
        $this->_invokeParams[$name] = $value;

=======
     * @param mixed $value
     * @return Zend_Controller_Router
     */
    public function setParam($name, $value)
    {
        $name = (string) $name;
        $this->_invokeParams[$name] = $value;
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
        return $this;
    }

    /**
     * Set parameters to pass to action controller constructors
     *
     * @param array $params
<<<<<<< HEAD
     * @return Zend_Controller_Router_Abstract
=======
     * @return Zend_Controller_Router
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
     */
    public function setParams(array $params)
    {
        $this->_invokeParams = array_merge($this->_invokeParams, $params);
<<<<<<< HEAD

=======
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
        return $this;
    }

    /**
     * Retrieve a single parameter from the controller parameter stack
     *
     * @param string $name
     * @return mixed
     */
    public function getParam($name)
    {
<<<<<<< HEAD
        if (isset($this->_invokeParams[$name])) {
=======
        if(isset($this->_invokeParams[$name])) {
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
            return $this->_invokeParams[$name];
        }

        return null;
    }

    /**
     * Retrieve action controller instantiation parameters
     *
     * @return array
     */
    public function getParams()
    {
        return $this->_invokeParams;
    }

    /**
     * Clear the controller parameter stack
     *
     * By default, clears all parameters. If a parameter name is given, clears
     * only that parameter; if an array of parameter names is provided, clears
     * each.
     *
     * @param null|string|array single key or array of keys for params to clear
<<<<<<< HEAD
     * @return Zend_Controller_Router_Abstract
=======
     * @return Zend_Controller_Router
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
     */
    public function clearParams($name = null)
    {
        if (null === $name) {
            $this->_invokeParams = array();
        } elseif (is_string($name) && isset($this->_invokeParams[$name])) {
            unset($this->_invokeParams[$name]);
        } elseif (is_array($name)) {
            foreach ($name as $key) {
                if (is_string($key) && isset($this->_invokeParams[$key])) {
                    unset($this->_invokeParams[$key]);
                }
            }
        }

        return $this;
    }

    /**
     * Retrieve Front Controller
     *
     * @return Zend_Controller_Front
     */
    public function getFrontController()
    {
        // Used cache version if found
        if (null !== $this->_frontController) {
            return $this->_frontController;
        }

        require_once 'Zend/Controller/Front.php';
        $this->_frontController = Zend_Controller_Front::getInstance();
<<<<<<< HEAD

=======
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
        return $this->_frontController;
    }

    /**
     * Set Front Controller
     *
     * @param Zend_Controller_Front $controller
     * @return Zend_Controller_Router_Interface
     */
    public function setFrontController(Zend_Controller_Front $controller)
    {
        $this->_frontController = $controller;
<<<<<<< HEAD

        return $this;
    }
=======
        return $this;
    }

>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
}
