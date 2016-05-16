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
 * @package    Zend_Service_Amazon
 * @subpackage SimpleDb
<<<<<<< HEAD
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
=======
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * @see Zend_Service_Amazon_Exception
 */
require_once 'Zend/Service/Amazon/Exception.php';

/**
 * The Custom Exception class that allows you to have access to the AWS Error Code.
 *
 * @category   Zend
 * @package    Zend_Service_Amazon
 * @subpackage SimpleDb
<<<<<<< HEAD
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
=======
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Service_Amazon_SimpleDb_Page
{
<<<<<<< HEAD
    /**
     * Page data
     *
     * @var string
     */
    protected $_data;

    /**
     * Token identifying page
     *
     * @var string|null
     */
=======
    /** @var string Page data */
    protected $_data;

    /** @var string|null Token identifying page */
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
    protected $_token;

    /**
     * Constructor
     *
<<<<<<< HEAD
     * @param string      $data
     * @param string|null $token
     */
    public function __construct($data, $token = null)
    {
        $this->setData($data);
        $this->setToken($token);
    }

    /**
     * Set page data
     *
     * @param string $data
     */
    public function setData($data)
    {
        $this->_data = $data;
=======
     * @param  string $data
     * @param  string|null $token
     * @return void
     */
    public function __construct($data, $token = null)
    {
        $this->_data  = $data;
        $this->_token = $token;
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
    }

    /**
     * Retrieve page data
     *
     * @return string
     */
    public function getData()
    {
        return $this->_data;
    }

    /**
<<<<<<< HEAD
     * Set token
     *
     * @param string|null $token
     */
    public function setToken($token)
    {
        $this->_token = (trim($token) === '') ? null : $token;
    }

    /**
=======
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
     * Retrieve token
     *
     * @return string|null
     */
    public function getToken()
    {
        return $this->_token;
    }

    /**
     * Determine whether this is the last page of data
     *
<<<<<<< HEAD
     * @return bool
=======
     * @return void
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
     */
    public function isLast()
    {
        return (null === $this->_token);
    }

    /**
     * Cast to string
     *
     * @return string
     */
    public function __toString()
    {
        return "Page with token: " . $this->_token
             . "\n and data: " . $this->_data;
    }
}
