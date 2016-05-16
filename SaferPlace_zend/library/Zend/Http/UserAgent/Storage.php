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
 * @package    Zend_Http
 * @subpackage UserAgent
<<<<<<< HEAD
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
=======
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * @category   Zend
 * @package    Zend_Http
 * @subpackage UserAgent
<<<<<<< HEAD
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
=======
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
interface Zend_Http_UserAgent_Storage
{
    /**
     * Returns true if and only if storage is empty
     *
     * @throws Zend_Http_UserAgent_Storage_Exception If it is impossible to determine whether storage is empty
     * @return boolean
     */
    public function isEmpty();

    /**
     * Returns the contents of storage associated to the key parameter
     *
     * Behavior is undefined when storage is empty.
     *
     * @throws Zend_Http_UserAgent_Storage_Exception If reading contents from storage is impossible
     * @return mixed
     */
    public function read();

    /**
     * Writes $contents associated to the key parameter to storage
     *
     * @param  mixed $contents
     * @throws Zend_Http_UserAgent_Storage_Exception If writing $contents to storage is impossible
     * @return void
     */
    public function write($contents);

    /**
     * Clears contents from storage
     *
     * @throws Zend_Http_UserAgent_Storage_Exception If clearing contents from storage is impossible
     * @return void
     */
    public function clear();
}