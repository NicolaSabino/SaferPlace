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
 * @package    Zend_Tool
 * @subpackage Framework
<<<<<<< HEAD
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
=======
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

require_once "Zend/Tool/Framework/Client/Response/ContentDecorator/Interface.php";

/**
 * Try to align a given text central on the screen.
 *
 * @category   Zend
 * @package    Zend_Tool
 * @subpackage Framework
<<<<<<< HEAD
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
=======
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: AlignCenter.php 24593 2012-01-05 20:35:02Z matthew $
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
 */
class Zend_Tool_Framework_Client_Console_ResponseDecorator_AlignCenter
    implements Zend_Tool_Framework_Client_Response_ContentDecorator_Interface
{
    public function getName()
    {
        return "aligncenter";
    }

    /**
     * @param string $content
     * @param integer $lineLength
     */
    public function decorate($content, $lineLength)
    {
        if(!is_numeric($lineLength)) {
            $lineLength = 72;
        }
        if(strlen($content) < $lineLength) {
            $append = false;
            $len = strlen($content);
            for($i = $len; $i < $lineLength; $i++) {
                if($append == true) {
                    $content = $content." ";
                    $append = false;
                } else {
                    $content = " ".$content;
                    $append = true;
                }
            }
        }
        return $content;
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
