<?php
/**
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
 * @package    Zend_Cloud
 * @subpackage QueueService
<<<<<<< HEAD
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
=======
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * Generic message class
 *
 * @category   Zend
 * @package    Zend_Cloud
 * @subpackage QueueService
<<<<<<< HEAD
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
=======
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Cloud_QueueService_Message
{
    protected $_body;
    protected $_clientMessage;

    /**
     * @param string $body Message text
     * @param string $message Original message
     */
    function __construct($body, $message)
    {
        $this->_body = $body;
        $this->_clientMessage = $message;
    }

    /**
     * Get the message body
     * @return string
     */
    public function getBody()
    {
        return $this->_body;
    }

    /**
     * Get the original adapter-specific message
     */
    public function getMessage()
    {
        return $this->_clientMessage;
    }
}
