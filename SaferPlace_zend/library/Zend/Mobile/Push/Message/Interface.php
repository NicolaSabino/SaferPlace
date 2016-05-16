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
 * @package    Zend_Mobile
 * @subpackage Zend_Mobile_Push
<<<<<<< HEAD
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
=======
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

/**
 * Push Message Interface
 *
 * @category   Zend
 * @package    Zend_Mobile
 * @subpackage Zend_Mobile_Push
<<<<<<< HEAD
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
=======
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */
interface Zend_Mobile_Push_Message_Interface
{
    /**
     * Get Token
     *
     * @return string
     */
    public function getToken();

    /**
     * Set Token
     *
     * @param string $token
     * @return Zend_Mobile_Push_Message_Abstract
     */
    public function setToken($token);

    /**
     * Get Id
     *
<<<<<<< HEAD
     * @return int|string|float|bool Scalar
=======
     * @return scalar
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
     */
    public function getId();

    /**
     * Set Id
     *
<<<<<<< HEAD
     * @param int|string|float|bool $id Scalar
=======
     * @param scalar $id
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
     * @return Zend_Mobile_Push_Message_Abstract
     */
    public function setId($id);

    /**
     * Set Options
     *
     * @param array $options
     * @return Zend_Mobile_Push_Message_Abstract
     */
    public function setOptions(array $options);

    /**
     * Validate Message
     *
     * @return boolean
     */
    public function validate();
}
