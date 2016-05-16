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
 * Take a text and block it into several lines of a fixed length.
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
 * @version    $Id: Blockize.php 24593 2012-01-05 20:35:02Z matthew $
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
 */
class Zend_Tool_Framework_Client_Console_ResponseDecorator_Blockize
    implements Zend_Tool_Framework_Client_Response_ContentDecorator_Interface
{
    public function getName()
    {
        return 'blockize';
    }

    /**
     *
     * @param  string $content
     * @param  int $lineLength
     * @return string
     */
    public function decorate($content, $lineLength)
    {
        if(intval(strval($lineLength)) != $lineLength) {
            $lineLength = 72;
        }

        // break apart the message into wrapped chunks
        $lines = explode(PHP_EOL, wordwrap($content, $lineLength, PHP_EOL, false));
        $content = array();
        foreach($lines AS $line) {
            if(strlen(trim($line)) == 0) {
                continue;
            }

            if(strlen($line) < $lineLength) {
                $line .= str_repeat(" ", $lineLength-strlen($line));
            }
            $content[] = $line;
        }
        return implode(PHP_EOL, $content);
    }
}
