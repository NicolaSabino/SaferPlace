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
 * @version    $Id$
=======
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @version    $Id: Module.php 24593 2012-01-05 20:35:02Z matthew $
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

/** Zend_Controller_Router_Route_Abstract */
require_once 'Zend/Controller/Router/Route/Abstract.php';

/**
 * Module Route
 *
 * Default route for module functionality
 *
 * @package    Zend_Controller
 * @subpackage Router
<<<<<<< HEAD
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
=======
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @see        http://manuals.rubyonrails.com/read/chapter/65
 */
class Zend_Controller_Router_Route_Module extends Zend_Controller_Router_Route_Abstract
{
<<<<<<< HEAD

    /**
     * Default values for the route (ie. module, controller, action, params)
     *
=======
    /**
     * Default values for the route (ie. module, controller, action, params)
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
     * @var array
     */
    protected $_defaults;

<<<<<<< HEAD
    /**
     * Default values for the route (ie. module, controller, action, params)
     *
     * @var array
     */
    protected $_values = array();

    /**
     * @var boolean
     */
    protected $_moduleValid = false;

    /**
     * @var boolean
     */
    protected $_keysSet = false;

    /**#@+
     * Array keys to use for module, controller, and action. Should be taken out of request.
     *
=======
    protected $_values      = array();
    protected $_moduleValid = false;
    protected $_keysSet     = false;

    /**#@+
     * Array keys to use for module, controller, and action. Should be taken out of request.
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
     * @var string
     */
    protected $_moduleKey     = 'module';
    protected $_controllerKey = 'controller';
    protected $_actionKey     = 'action';
    /**#@-*/

    /**
     * @var Zend_Controller_Dispatcher_Interface
     */
    protected $_dispatcher;

    /**
     * @var Zend_Controller_Request_Abstract
     */
    protected $_request;

<<<<<<< HEAD
    /**
     * Get the version of the route
     *
     * @return int
     */
    public function getVersion()
    {
=======
    public function getVersion() {
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
        return 1;
    }

    /**
     * Instantiates route based on passed Zend_Config structure
<<<<<<< HEAD
     *
     * @param Zend_Config $config
     * @return Zend_Controller_Router_Route_Module
=======
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
     */
    public static function getInstance(Zend_Config $config)
    {
        $frontController = Zend_Controller_Front::getInstance();

        $defs       = ($config->defaults instanceof Zend_Config) ? $config->defaults->toArray() : array();
        $dispatcher = $frontController->getDispatcher();
        $request    = $frontController->getRequest();

        return new self($defs, $dispatcher, $request);
    }

    /**
     * Constructor
     *
<<<<<<< HEAD
     * @param array                                $defaults   Defaults for map variables with keys as variable names
     * @param Zend_Controller_Dispatcher_Interface $dispatcher Dispatcher object
     * @param Zend_Controller_Request_Abstract     $request    Request object
     */
    public function __construct(
        array $defaults = array(),
        Zend_Controller_Dispatcher_Interface $dispatcher = null,
        Zend_Controller_Request_Abstract $request = null
    )
=======
     * @param array $defaults Defaults for map variables with keys as variable names
     * @param Zend_Controller_Dispatcher_Interface $dispatcher Dispatcher object
     * @param Zend_Controller_Request_Abstract $request Request object
     */
    public function __construct(array $defaults = array(),
                Zend_Controller_Dispatcher_Interface $dispatcher = null,
                Zend_Controller_Request_Abstract $request = null)
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
    {
        $this->_defaults = $defaults;

        if (isset($request)) {
            $this->_request = $request;
        }

        if (isset($dispatcher)) {
            $this->_dispatcher = $dispatcher;
        }
    }

    /**
     * Set request keys based on values in request object
     *
     * @return void
     */
    protected function _setRequestKeys()
    {
        if (null !== $this->_request) {
            $this->_moduleKey     = $this->_request->getModuleKey();
            $this->_controllerKey = $this->_request->getControllerKey();
            $this->_actionKey     = $this->_request->getActionKey();
        }

        if (null !== $this->_dispatcher) {
            $this->_defaults += array(
                $this->_controllerKey => $this->_dispatcher->getDefaultControllerName(),
                $this->_actionKey     => $this->_dispatcher->getDefaultAction(),
                $this->_moduleKey     => $this->_dispatcher->getDefaultModule()
            );
        }

        $this->_keysSet = true;
    }

    /**
     * Matches a user submitted path. Assigns and returns an array of variables
     * on a successful match.
     *
     * If a request object is registered, it uses its setModuleName(),
     * setControllerName(), and setActionName() accessors to set those values.
     * Always returns the values as an array.
     *
<<<<<<< HEAD
     * @param string  $path Path used to match against this routing map
     * @param boolean $partial
=======
     * @param string $path Path used to match against this routing map
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
     * @return array An array of assigned values or a false on a mismatch
     */
    public function match($path, $partial = false)
    {
        $this->_setRequestKeys();

        $values = array();
        $params = array();

        if (!$partial) {
            $path = trim($path, self::URI_DELIMITER);
        } else {
            $matchedPath = $path;
        }

        if ($path != '') {
            $path = explode(self::URI_DELIMITER, $path);

            if ($this->_dispatcher && $this->_dispatcher->isValidModule($path[0])) {
                $values[$this->_moduleKey] = array_shift($path);
<<<<<<< HEAD
                $this->_moduleValid        = true;
=======
                $this->_moduleValid = true;
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
            }

            if (count($path) && !empty($path[0])) {
                $values[$this->_controllerKey] = array_shift($path);
            }

            if (count($path) && !empty($path[0])) {
                $values[$this->_actionKey] = array_shift($path);
            }

            if ($numSegs = count($path)) {
                for ($i = 0; $i < $numSegs; $i = $i + 2) {
<<<<<<< HEAD
                    $key          = urldecode($path[$i]);
                    $val          = isset($path[$i + 1]) ? urldecode($path[$i + 1]) : null;
                    $params[$key] = (isset($params[$key]) ? (array_merge((array)$params[$key], array($val))) : $val);
=======
                    $key = urldecode($path[$i]);
                    $val = isset($path[$i + 1]) ? urldecode($path[$i + 1]) : null;
                    $params[$key] = (isset($params[$key]) ? (array_merge((array) $params[$key], array($val))): $val);
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
                }
            }
        }

        if ($partial) {
            $this->setMatchedPath($matchedPath);
        }

        $this->_values = $values + $params;

        return $this->_values + $this->_defaults;
    }

    /**
     * Assembles user submitted parameters forming a URL path defined by this route
     *
<<<<<<< HEAD
     * @param array   $data  An array of variable and value pairs used as parameters
     * @param boolean $reset Weither to reset the current params
     * @param boolean $encode
     * @param boolean $partial
=======
     * @param array $data An array of variable and value pairs used as parameters
     * @param bool $reset Weither to reset the current params
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
     * @return string Route path with user submitted parameters
     */
    public function assemble($data = array(), $reset = false, $encode = true, $partial = false)
    {
        if (!$this->_keysSet) {
            $this->_setRequestKeys();
        }

        $params = (!$reset) ? $this->_values : array();

        foreach ($data as $key => $value) {
            if ($value !== null) {
                $params[$key] = $value;
            } elseif (isset($params[$key])) {
                unset($params[$key]);
            }
        }

        $params += $this->_defaults;

        $url = '';

        if ($this->_moduleValid || array_key_exists($this->_moduleKey, $data)) {
            if ($params[$this->_moduleKey] != $this->_defaults[$this->_moduleKey]) {
                $module = $params[$this->_moduleKey];
            }
        }
        unset($params[$this->_moduleKey]);

        $controller = $params[$this->_controllerKey];
        unset($params[$this->_controllerKey]);

        $action = $params[$this->_actionKey];
        unset($params[$this->_actionKey]);

        foreach ($params as $key => $value) {
            $key = ($encode) ? urlencode($key) : $key;
            if (is_array($value)) {
                foreach ($value as $arrayValue) {
                    $arrayValue = ($encode) ? urlencode($arrayValue) : $arrayValue;
                    $url .= self::URI_DELIMITER . $key;
                    $url .= self::URI_DELIMITER . $arrayValue;
                }
            } else {
<<<<<<< HEAD
                if ($encode) {
                    $value = urlencode($value);
                }
=======
                if ($encode) $value = urlencode($value);
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
                $url .= self::URI_DELIMITER . $key;
                $url .= self::URI_DELIMITER . $value;
            }
        }

        if (!empty($url) || $action !== $this->_defaults[$this->_actionKey]) {
<<<<<<< HEAD
            if ($encode) {
                $action = urlencode($action);
            }
=======
            if ($encode) $action = urlencode($action);
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
            $url = self::URI_DELIMITER . $action . $url;
        }

        if (!empty($url) || $controller !== $this->_defaults[$this->_controllerKey]) {
<<<<<<< HEAD
            if ($encode) {
                $controller = urlencode($controller);
            }
=======
            if ($encode) $controller = urlencode($controller);
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
            $url = self::URI_DELIMITER . $controller . $url;
        }

        if (isset($module)) {
<<<<<<< HEAD
            if ($encode) {
                $module = urlencode($module);
            }
=======
            if ($encode) $module = urlencode($module);
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
            $url = self::URI_DELIMITER . $module . $url;
        }

        return ltrim($url, self::URI_DELIMITER);
    }

    /**
     * Return a single parameter of route's defaults
     *
     * @param string $name Array key of the parameter
     * @return string Previously set default
     */
<<<<<<< HEAD
    public function getDefault($name)
    {
=======
    public function getDefault($name) {
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
        if (isset($this->_defaults[$name])) {
            return $this->_defaults[$name];
        }
    }

    /**
     * Return an array of defaults
     *
     * @return array Route defaults
     */
<<<<<<< HEAD
    public function getDefaults()
    {
        return $this->_defaults;
    }
=======
    public function getDefaults() {
        return $this->_defaults;
    }

>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
}
