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
 * @package    Zend_Service_WindowsAzure
 * @subpackage Storage
<<<<<<< HEAD
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
=======
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: QueueMessage.php 24593 2012-01-05 20:35:02Z matthew $
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
 */

/**
 * @see Zend_Service_WindowsAzure_Storage_StorageEntityAbstract
 */
require_once 'Zend/Service/WindowsAzure/Storage/StorageEntityAbstract.php';

/**
 * @category   Zend
 * @package    Zend_Service_WindowsAzure
 * @subpackage Storage
<<<<<<< HEAD
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
=======
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 *   
 * @property string $MessageId         Message ID
 * @property string $InsertionTime     Insertion time
 * @property string $ExpirationTime    Expiration time
 * @property string $PopReceipt  	   Receipt verification for deleting the message from queue.
 * @property string $TimeNextVisible   Next time the message is visible in the queue
 * @property int    $DequeueCount      Number of times the message has been dequeued. This value is incremented each time the message is subsequently dequeued.
 * @property string $MessageText       Message text
 */
class Zend_Service_WindowsAzure_Storage_QueueMessage
	extends Zend_Service_WindowsAzure_Storage_StorageEntityAbstract
{
    /**
     * Constructor
     * 
     * @param string $messageId         Message ID
     * @param string $insertionTime     Insertion time
     * @param string $expirationTime    Expiration time
     * @param string $popReceipt  	    Receipt verification for deleting the message from queue.
     * @param string $timeNextVisible   Next time the message is visible in the queue
     * @param int    $dequeueCount      Number of times the message has been dequeued. This value is incremented each time the message is subsequently dequeued.
     * @param string $messageText       Message text
     */
    public function __construct($messageId, $insertionTime, $expirationTime, $popReceipt, $timeNextVisible, $dequeueCount, $messageText) 
    {
        $this->_data = array(
            'messageid'       => $messageId,
            'insertiontime'   => $insertionTime,
            'expirationtime'  => $expirationTime,
            'popreceipt'      => $popReceipt,
            'timenextvisible' => $timeNextVisible,
        	'dequeuecount'    => $dequeueCount,
            'messagetext'     => $messageText
        );
    }
}