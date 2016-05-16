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
 * @version    $Id: Hostname.php 24593 2012-01-05 20:35:02Z matthew $
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

/** Zend_Controller_Router_Route_Abstract */
require_once 'Zend/Controller/Router/Route/Abstract.php';

/**
 * Hostname Route
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
class Zend_Controller_Router_Route_Hostname extends Zend_Controller_Router_Route_Abstract
{

<<<<<<< HEAD
    /**
     * Host variable
     *
     * @var string
     */
    protected $_hostVariable = ':';

    /**
     * Regex delimiter
     *
     * @var string
     */
    protected $_regexDelimiter = '#';

    /**
     * Default regex string
     *
     * @var string|null
     */
    protected $_defaultRegex = null;

    /**
     * Holds names of all route's pattern variable names. Array index holds a position in host.
     *
=======
    protected $_hostVariable   = ':';
    protected $_regexDelimiter = '#';
    protected $_defaultRegex   = null;

    /**
     * Holds names of all route's pattern variable names. Array index holds a position in host.
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
     * @var array
     */
    protected $_variables = array();

    /**
     * Holds Route patterns for all host parts. In case of a variable it stores it's regex
     * requirement or null. In case of a static part, it holds only it's direct value.
<<<<<<< HEAD
     *
=======
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
     * @var array
     */
    protected $_parts = array();

    /**
     * Holds user submitted default values for route's variables. Name and value pairs.
<<<<<<< HEAD
     *
=======
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
     * @var array
     */
    protected $_defaults = array();

    /**
     * Holds user submitted regular expression patterns for route's variables' values.
     * Name and value pairs.
<<<<<<< HEAD
     *
=======
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
     * @var array
     */
    protected $_requirements = array();

    /**
     * Default scheme
<<<<<<< HEAD
     *
=======
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
     * @var string
     */
    protected $_scheme = null;

    /**
     * Associative array filled on match() that holds matched path values
     * for given variable names.
<<<<<<< HEAD
     *
=======
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
     * @var array
     */
    protected $_values = array();

    /**
     * Current request object
     *
     * @var Zend_Controller_Request_Abstract
     */
    protected $_request;

    /**
     * Helper var that holds a count of route pattern's static parts
     * for validation
<<<<<<< HEAD
     *
=======
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
     * @var int
     */
    private $_staticCount = 0;

    /**
     * Set the request object
     *
     * @param  Zend_Controller_Request_Abstract|null $request
<<<<<<< HEAD
=======
     * @return void
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
     */
    public function setRequest(Zend_Controller_Request_Abstract $request = null)
    {
        $this->_request = $request;
    }

    /**
     * Get the request object
     *
     * @return Zend_Controller_Request_Abstract $request
     */
    public function getRequest()
    {
        if ($this->_request === null) {
            require_once 'Zend/Controller/Front.php';
            $this->_request = Zend_Controller_Front::getInstance()->getRequest();
        }

        return $this->_request;
    }

    /**
     * Instantiates route based on passed Zend_Config structure
     *
     * @param Zend_Config $config Configuration object
<<<<<<< HEAD
     * @return Zend_Controller_Router_Route_Hostname
=======
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
     */
    public static function getInstance(Zend_Config $config)
    {
        $reqs   = ($config->reqs instanceof Zend_Config) ? $config->reqs->toArray() : array();
        $defs   = ($config->defaults instanceof Zend_Config) ? $config->defaults->toArray() : array();
        $scheme = (isset($config->scheme)) ? $config->scheme : null;
<<<<<<< HEAD

=======
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
        return new self($config->route, $defs, $reqs, $scheme);
    }

    /**
     * Prepares the route for mapping by splitting (exploding) it
     * to a corresponding atomic parts. These parts are assigned
     * a position which is later used for matching and preparing values.
     *
<<<<<<< HEAD
     * @param string $route    Map used to match with later submitted hostname
     * @param array  $defaults Defaults for map variables with keys as variable names
     * @param array  $reqs     Regular expression requirements for variables (keys as variable names)
=======
     * @param string $route Map used to match with later submitted hostname
     * @param array  $defaults Defaults for map variables with keys as variable names
     * @param array  $reqs Regular expression requirements for variables (keys as variable names)
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
     * @param string $scheme
     */
    public function __construct($route, $defaults = array(), $reqs = array(), $scheme = null)
    {
        $route               = trim($route, '.');
        $this->_defaults     = (array) $defaults;
        $this->_requirements = (array) $reqs;
        $this->_scheme       = $scheme;

        if ($route != '') {
            foreach (explode('.', $route) as $pos => $part) {
                if (substr($part, 0, 1) == $this->_hostVariable) {
<<<<<<< HEAD
                    $name                   = substr($part, 1);
                    $this->_parts[$pos]     = (isset($reqs[$name]) ? $reqs[$name] : $this->_defaultRegex);
=======
                    $name = substr($part, 1);
                    $this->_parts[$pos] = (isset($reqs[$name]) ? $reqs[$name] : $this->_defaultRegex);
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
                    $this->_variables[$pos] = $name;
                } else {
                    $this->_parts[$pos] = $part;
                    $this->_staticCount++;
                }
            }
        }
    }

    /**
     * Matches a user submitted path with parts defined by a map. Assigns and
     * returns an array of variables on a successful match.
     *
     * @param Zend_Controller_Request_Http $request Request to get the host from
     * @return array|false An array of assigned values or a false on a mismatch
     */
    public function match($request)
    {
        // Check the scheme if required
        if ($this->_scheme !== null) {
            $scheme = $request->getScheme();

            if ($scheme !== $this->_scheme) {
                return false;
            }
        }

        // Get the host and remove unnecessary port information
        $host = $request->getHttpHost();
        if (preg_match('#:\d+$#', $host, $result) === 1) {
            $host = substr($host, 0, -strlen($result[0]));
        }

        $hostStaticCount = 0;
<<<<<<< HEAD
        $values          = array();
=======
        $values = array();
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f

        $host = trim($host, '.');

        if ($host != '') {
            $host = explode('.', $host);

            foreach ($host as $pos => $hostPart) {
                // Host is longer than a route, it's not a match
                if (!array_key_exists($pos, $this->_parts)) {
                    return false;
                }

<<<<<<< HEAD
                $name     = isset($this->_variables[$pos]) ? $this->_variables[$pos] : null;
=======
                $name = isset($this->_variables[$pos]) ? $this->_variables[$pos] : null;
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
                $hostPart = urldecode($hostPart);

                // If it's a static part, match directly
                if ($name === null && $this->_parts[$pos] != $hostPart) {
                    return false;
                }

                // If it's a variable with requirement, match a regex. If not - everything matches
<<<<<<< HEAD
                if ($this->_parts[$pos] !== null
                    && !preg_match(
                        $this->_regexDelimiter . '^' . $this->_parts[$pos] . '$' . $this->_regexDelimiter . 'iu',
                        $hostPart
                    )
                ) {
=======
                if ($this->_parts[$pos] !== null && !preg_match($this->_regexDelimiter . '^' . $this->_parts[$pos] . '$' . $this->_regexDelimiter . 'iu', $hostPart)) {
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
                    return false;
                }

                // If it's a variable store it's value for later
                if ($name !== null) {
                    $values[$name] = $hostPart;
                } else {
                    $hostStaticCount++;
                }
            }
        }

        // Check if all static mappings have been matched
        if ($this->_staticCount != $hostStaticCount) {
            return false;
        }

        $return = $values + $this->_defaults;

        // Check if all map variables have been initialized
        foreach ($this->_variables as $var) {
            if (!array_key_exists($var, $return)) {
                return false;
            }
        }

        $this->_values = $values;

        return $return;
<<<<<<< HEAD
=======

>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
    }

    /**
     * Assembles user submitted parameters forming a hostname defined by this route
     *
<<<<<<< HEAD
     * @param  array   $data  An array of variable and value pairs used as parameters
     * @param  boolean $reset Whether or not to set route defaults with those provided in $data
     * @param  boolean $encode
     * @param  boolean $partial
     * @throws Zend_Controller_Router_Exception
=======
     * @param  array $data An array of variable and value pairs used as parameters
     * @param  boolean $reset Whether or not to set route defaults with those provided in $data
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
     * @return string Route path with user submitted parameters
     */
    public function assemble($data = array(), $reset = false, $encode = false, $partial = false)
    {
        $host = array();
        $flag = false;

        foreach ($this->_parts as $key => $part) {
            $name = isset($this->_variables[$key]) ? $this->_variables[$key] : null;

            $useDefault = false;
            if (isset($name) && array_key_exists($name, $data) && $data[$name] === null) {
                $useDefault = true;
            }

            if (isset($name)) {
                if (isset($data[$name]) && !$useDefault) {
                    $host[$key] = $data[$name];
                    unset($data[$name]);
                } elseif (!$reset && !$useDefault && isset($this->_values[$name])) {
                    $host[$key] = $this->_values[$name];
                } elseif (isset($this->_defaults[$name])) {
                    $host[$key] = $this->_defaults[$name];
                } else {
                    require_once 'Zend/Controller/Router/Exception.php';
                    throw new Zend_Controller_Router_Exception($name . ' is not specified');
                }
            } else {
                $host[$key] = $part;
            }
        }

        $return = '';

        foreach (array_reverse($host, true) as $key => $value) {
<<<<<<< HEAD
            if ($flag || !isset($this->_variables[$key]) || $value !== $this->getDefault($this->_variables[$key])
                || $partial
            ) {
                if ($encode) {
                    $value = urlencode($value);
                }
                $return = '.' . $value . $return;
                $flag   = true;
=======
            if ($flag || !isset($this->_variables[$key]) || $value !== $this->getDefault($this->_variables[$key]) || $partial) {
                if ($encode) $value = urlencode($value);
                $return = '.' . $value . $return;
                $flag = true;
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
            }
        }

        $url = trim($return, '.');

        if ($this->_scheme !== null) {
            $scheme = $this->_scheme;
        } else {
            $request = $this->getRequest();
            if ($request instanceof Zend_Controller_Request_Http) {
                $scheme = $request->getScheme();
            } else {
                $scheme = 'http';
            }
        }

<<<<<<< HEAD
        $url = $scheme . '://' . $url;
=======
        $url      = $scheme . '://' . $url;
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f

        return $url;
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
        if (isset($this->_defaults[$name])) {
            return $this->_defaults[$name];
        }

=======
    public function getDefault($name) {
        if (isset($this->_defaults[$name])) {
            return $this->_defaults[$name];
        }
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
        return null;
    }

    /**
     * Return an array of defaults
     *
     * @return array Route defaults
     */
<<<<<<< HEAD
    public function getDefaults()
    {
=======
    public function getDefaults() {
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
        return $this->_defaults;
    }

    /**
     * Get all variables which are used by the route
     *
     * @return array
     */
    public function getVariables()
    {
        return $this->_variables;
    }
}
