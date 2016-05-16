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
 * @package    Zend_Service
 * @subpackage Flickr
<<<<<<< HEAD
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
=======
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: Image.php 24593 2012-01-05 20:35:02Z matthew $
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
 */


/**
 * @category   Zend
 * @package    Zend_Service
 * @subpackage Flickr
<<<<<<< HEAD
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
=======
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Service_Flickr_Image
{
    /**
     * The URI of the image
     *
     * @var string
     */
    public $uri;

    /**
     * The URI for linking to the photo on Flickr
     *
     * @var string
     */
    public $clickUri;

    /**
     * The height of the image in pixels
     *
     * @var string
     */
    public $height;

    /**
     * The width of the image in pixels
     *
     * @var string
     */
    public $width;

    /**
     * Parse given Flickr Image element
     *
     * @param  DOMElement $image
     * @return void
     */
    public function __construct(DOMElement $image)
    {
        $this->uri      = (string) $image->getAttribute('source');
        $this->clickUri = (string) $image->getAttribute('url');
        $this->height   = (int) $image->getAttribute('height');
        $this->width    = (int) $image->getAttribute('width');
    }
}

