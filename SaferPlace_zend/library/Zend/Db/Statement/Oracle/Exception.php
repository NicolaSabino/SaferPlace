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
 * @package    Zend_Db
 * @subpackage Statement
<<<<<<< HEAD
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
=======
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: Exception.php 24593 2012-01-05 20:35:02Z matthew $
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
 */

/**
 * Zend_Db_Statement_Exception
 */
require_once 'Zend/Db/Statement/Exception.php';

/**
 * @category   Zend
 * @package    Zend_Db
 * @subpackage Statement
<<<<<<< HEAD
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
=======
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

class Zend_Db_Statement_Oracle_Exception extends Zend_Db_Statement_Exception
{
   protected $message = 'Unknown exception';
   protected $code = 0;

   function __construct($error = null, $code = 0)
   {
       if (is_array($error)) {
            if (!isset($error['offset'])) {
                $this->message = $error['code']." ".$error['message'];
            } else {
                $this->message = $error['code']." ".$error['message']." ";
                $this->message .= substr($error['sqltext'], 0, $error['offset']);
                $this->message .= "*";
                $this->message .= substr($error['sqltext'], $error['offset']);
            }
            $this->code = $error['code'];
       }
       if (!$this->code && $code) {
           $this->code = $code;
       }
   }
}
