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
 * @package    Zend_Barcode
 * @subpackage Object
<<<<<<< HEAD
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
=======
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: Error.php 24593 2012-01-05 20:35:02Z matthew $
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
 */

/** @see Zend_Barcode_Object_ObjectAbstract */
require_once 'Zend/Barcode/Object/ObjectAbstract.php';

/**
 * Class for generate Barcode
 *
 * @category   Zend
 * @package    Zend_Barcode
<<<<<<< HEAD
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
=======
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Barcode_Object_Error extends Zend_Barcode_Object_ObjectAbstract
{
    /**
     * All texts are accepted
     * @param string $value
     * @return boolean
     */
    public function validateText($value)
    {
        return true;
    }

    /**
     * Height is forced
<<<<<<< HEAD
     *
     * @param bool $recalculate
=======
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
     * @return integer
     */
    public function getHeight($recalculate = false)
    {
        return 40;
    }

    /**
     * Width is forced
<<<<<<< HEAD
     *
     * @param bool $recalculate
=======
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
     * @return integer
     */
    public function getWidth($recalculate = false)
    {
        return 400;
    }

    /**
     * Reset precedent instructions
     * and draw the error message
     * @return array
     */
    public function draw()
    {
        $this->_instructions = array();
        $this->_addText('ERROR:', 10, array(5 , 18), $this->_font, 0, 'left');
        $this->_addText($this->_text, 10, array(5 , 32), $this->_font, 0, 'left');
        return $this->_instructions;
    }

    /**
     * For compatibility reason
     * @return void
     */
    protected function _prepareBarcode()
    {
    }

    /**
     * For compatibility reason
     * @return void
     */
    protected function _checkParams()
    {
    }

    /**
     * For compatibility reason
     * @return void
     */
    protected function _calculateBarcodeWidth()
    {
    }
}
