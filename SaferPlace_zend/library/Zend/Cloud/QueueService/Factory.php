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
 * @package    Zend_Cloud
 * @subpackage QueueService
<<<<<<< HEAD
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
=======
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

require_once 'Zend/Cloud/AbstractFactory.php';

/**
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
class Zend_Cloud_QueueService_Factory extends Zend_Cloud_AbstractFactory
{
    const QUEUE_ADAPTER_KEY = 'queue_adapter';

    /**
     * @var string Interface which adapter must implement to be considered valid
     */
    protected static $_adapterInterface = 'Zend_Cloud_QueueService_Adapter';

    /**
     * Constructor
<<<<<<< HEAD
=======
     *
     * @return void
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
     */
    private function __construct()
    {
        // private ctor - should not be used
    }

    /**
     * Retrieve QueueService adapter
     *
     * @param  array $options
<<<<<<< HEAD
     * @return null|Zend_Cloud_DocumentService_Adapter|Zend_Cloud_QueueService_Adapter|Zend_Cloud_StorageService_Adapter
     * @throws Zend_Cloud_QueueService_Exception
=======
     * @return void
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
     */
    public static function getAdapter($options = array())
    {
        $adapter = parent::_getAdapter(self::QUEUE_ADAPTER_KEY, $options);
        if (!$adapter) {
            require_once 'Zend/Cloud/QueueService/Exception.php';
            throw new Zend_Cloud_QueueService_Exception('Class must be specified using the \'' .
            self::QUEUE_ADAPTER_KEY . '\' key');
        } elseif (!$adapter instanceof self::$_adapterInterface) {
            require_once 'Zend/Cloud/QueueService/Exception.php';
            throw new Zend_Cloud_QueueService_Exception(
                'Adapter must implement \'' . self::$_adapterInterface . '\''
            );
        }
        return $adapter;
    }
}
