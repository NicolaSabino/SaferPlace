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
 * @package    Zend_Crypt
 * @subpackage Math
<<<<<<< HEAD
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
=======
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: Bcmath.php 24593 2012-01-05 20:35:02Z matthew $
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
 */

/**
 * @see Zend_Crypt_Math_BigInteger_Interface
 */
require_once 'Zend/Crypt/Math/BigInteger/Interface.php';

/**
 * Support for arbitrary precision mathematics in PHP.
 *
 * Zend_Crypt_Math_BigInteger_Bcmath is a wrapper across the PHP BCMath
 * extension.
 *
 * @category   Zend
 * @package    Zend_Crypt
<<<<<<< HEAD
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
=======
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Crypt_Math_BigInteger_Bcmath implements Zend_Crypt_Math_BigInteger_Interface
{

    /**
     * Initialise a big integer into an extension specific type. This is not
     * applicable to BCMath.
<<<<<<< HEAD
     *
=======
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
     * @param string $operand
     * @param int $base
     * @return string
     */
    public function init($operand, $base = 10)
    {
        return $operand;
    }

    /**
     * Adds two arbitrary precision numbers
     *
     * @param string $left_operand
     * @param string $right_operand
     * @return string
     */
    public function add($left_operand, $right_operand)
    {
        return bcadd($left_operand, $right_operand);
    }

    /**
<<<<<<< HEAD
     * Subtract one arbitrary precision number from another
     *
=======
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
     * @param string $left_operand
     * @param string $right_operand
     * @return string
     */
    public function subtract($left_operand, $right_operand)
    {
        return bcsub($left_operand, $right_operand);
    }

    /**
     * Compare two big integers and returns result as an integer where 0 means
     * both are identical, 1 that left_operand is larger, or -1 that
     * right_operand is larger.
<<<<<<< HEAD
     *
=======
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
     * @param string $left_operand
     * @param string $right_operand
     * @return int
     */
    public function compare($left_operand, $right_operand)
    {
        return bccomp($left_operand, $right_operand);
    }

    /**
     * Divide two big integers and return result or NULL if the denominator
     * is zero.
<<<<<<< HEAD
     *
=======
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
     * @param string $left_operand
     * @param string $right_operand
     * @return string|null
     */
    public function divide($left_operand, $right_operand)
    {
        return bcdiv($left_operand, $right_operand);
    }

    /**
<<<<<<< HEAD
     * Get modulus of an arbitrary precision number
     *
     * @param string $left_operand
     * @param string $modulus
=======
     * @param string $left_operand
     * @param string $right_operand
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
     * @return string
     */
    public function modulus($left_operand, $modulus)
    {
        return bcmod($left_operand, $modulus);
    }

    /**
<<<<<<< HEAD
     * Multiply two arbitrary precision numbers
     *
=======
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
     * @param string $left_operand
     * @param string $right_operand
     * @return string
     */
    public function multiply($left_operand, $right_operand)
    {
        return bcmul($left_operand, $right_operand);
    }

    /**
<<<<<<< HEAD
     * Raise an arbitrary precision number to another
     *
=======
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
     * @param string $left_operand
     * @param string $right_operand
     * @return string
     */
    public function pow($left_operand, $right_operand)
    {
        return bcpow($left_operand, $right_operand);
    }

    /**
<<<<<<< HEAD
     * Raise an arbitrary precision number to another, reduced by a specified
     * modulus
     *
     * @param string $left_operand
     * @param string $right_operand
     * @param string $modulus
=======
     * @param string $left_operand
     * @param string $right_operand
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
     * @return string
     */
    public function powmod($left_operand, $right_operand, $modulus)
    {
        return bcpowmod($left_operand, $right_operand, $modulus);
    }

    /**
<<<<<<< HEAD
     * Get the square root of an arbitrary precision number
     *
     * @param string $operand
=======
     * @param string $left_operand
     * @param string $right_operand
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
     * @return string
     */
    public function sqrt($operand)
    {
        return bcsqrt($operand);
    }

<<<<<<< HEAD
    /**
     * @param string $operand
     * @return string
     */
=======

>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
    public function binaryToInteger($operand)
    {
        $result = '0';
        while (strlen($operand)) {
            $ord = ord(substr($operand, 0, 1));
            $result = bcadd(bcmul($result, 256), $ord);
            $operand = substr($operand, 1);
        }
        return $result;
    }

<<<<<<< HEAD
    /**
     * @param string $operand
     * @return string
     */
=======

>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
    public function integerToBinary($operand)
    {
        $cmp = bccomp($operand, 0);
        $return = '';
        if ($cmp == 0) {
            return "\0";
        }
        while (bccomp($operand, 0) > 0) {
            $return = chr(bcmod($operand, 256)) . $return;
            $operand = bcdiv($operand, 256);
        }
        if (ord($return[0]) > 127) {
            $return = "\0" . $return;
        }
        return $return;
    }

    /**public function integerToBinary($operand)
    {
        $return = '';
        while(bccomp($operand, '0')) {
            $return .= chr(bcmod($operand, '256'));
            $operand = bcdiv($operand, '256');
        }
        return $return;
    }**/ // Prior version for referenced offset

<<<<<<< HEAD
    /**
     * @param string $operand
     * @return string
     */
=======

>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
    public function hexToDecimal($operand)
    {
        $return = '0';
        while(strlen($hex)) {
            $hex = hexdec(substr($operand, 0, 4));
            $dec = bcadd(bcmul($return, 65536), $hex);
            $operand = substr($operand, 4);
        }
        return $return;
    }
<<<<<<< HEAD
}
=======

}
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
