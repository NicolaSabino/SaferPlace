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
<<<<<<< HEAD
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
=======
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * Abstract factory for Zend_Cloud resources
 *
 * @category   Zend
 * @package    Zend_Cloud
<<<<<<< HEAD
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
=======
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Cloud_AbstractFactory
{
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
     * Get an individual adapter instance
     *
     * @param  string $adapterOption
     * @param  array|Zend_Config $options
     * @return null|Zend_Cloud_DocumentService_Adapter|Zend_Cloud_QueueService_Adapter|Zend_Cloud_StorageService_Adapter
     */
    protected static function _getAdapter($adapterOption, $options)
    {
        if ($options instanceof Zend_Config) {
            $options = $options->toArray();
        }

        if (!isset($options[$adapterOption])) {
            return null;
        }

        $classname = $options[$adapterOption];
        unset($options[$adapterOption]);
        if (!class_exists($classname)) {
            require_once 'Zend/Loader.php';
            Zend_Loader::loadClass($classname);
        }

        return new $classname($options);
    }
}
