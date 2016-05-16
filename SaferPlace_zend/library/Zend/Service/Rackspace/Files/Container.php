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
 * @package    Zend_Service_Rackspace
 * @subpackage Files
<<<<<<< HEAD
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
=======
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

require_once 'Zend/Service/Rackspace/Files.php';

class Zend_Service_Rackspace_Files_Container
{
<<<<<<< HEAD
    const ERROR_PARAM_FILE_CONSTRUCT = 'The Zend_Service_Rackspace_Files passed in construction is not valid';

    const ERROR_PARAM_ARRAY_CONSTRUCT = 'The array passed in construction is not valid';

    const ERROR_PARAM_NO_NAME = 'The container name is empty';

=======
    const ERROR_PARAM_FILE_CONSTRUCT  = 'The Zend_Service_Rackspace_Files passed in construction is not valid';
    const ERROR_PARAM_ARRAY_CONSTRUCT = 'The array passed in construction is not valid';
    const ERROR_PARAM_NO_NAME         = 'The container name is empty';
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
    /**
     * @var string
     */
    protected $name;
<<<<<<< HEAD

=======
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
    /**
     * Construct
     *
     * @param Zend_Service_Rackspace_Files $service
<<<<<<< HEAD
     * @param                              $data
     *
     * @throws Zend_Service_Rackspace_Files_Exception
=======
     * @param string $name
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
     */
    public function __construct($service, $data)
    {
        if (!($service instanceof Zend_Service_Rackspace_Files)) {
            require_once 'Zend/Service/Rackspace/Files/Exception.php';
<<<<<<< HEAD
            throw new Zend_Service_Rackspace_Files_Exception(
                self::ERROR_PARAM_FILE_CONSTRUCT
            );
        }
        if (!is_array($data)) {
            require_once 'Zend/Service/Rackspace/Files/Exception.php';
            throw new Zend_Service_Rackspace_Files_Exception(
                self::ERROR_PARAM_ARRAY_CONSTRUCT
            );
        }
        if (!array_key_exists('name', $data)) {
            require_once 'Zend/Service/Rackspace/Files/Exception.php';
            throw new Zend_Service_Rackspace_Files_Exception(
                self::ERROR_PARAM_NO_NAME
            );
        }
        $this->service = $service;
        $this->name    = $data['name'];
    }

=======
            throw new Zend_Service_Rackspace_Files_Exception(self::ERROR_PARAM_FILE_CONSTRUCT);
        }
        if (!is_array($data)) {
            require_once 'Zend/Service/Rackspace/Files/Exception.php';
            throw new Zend_Service_Rackspace_Files_Exception(self::ERROR_PARAM_ARRAY_CONSTRUCT);
        }
        if (!array_key_exists('name', $data)) {
            require_once 'Zend/Service/Rackspace/Files/Exception.php';
            throw new Zend_Service_Rackspace_Files_Exception(self::ERROR_PARAM_NO_NAME);
        }    
        $this->service = $service;
        $this->name = $data['name'];
    }
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
    /**
     * Get the name of the container
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
<<<<<<< HEAD

    /**
     * Get the size in bytes of the container
     *
     * @return integer|bool
=======
    /**
     * Get the size in bytes of the container
     *
     * @return integer|boolean
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
     */
    public function getSize()
    {
        $data = $this->getInfo();
        if (isset($data['bytes'])) {
            return $data['bytes'];
        }
<<<<<<< HEAD

        return false;
    }

    /**
     * Get the total count of objects in the container
     *
     * @return integer|bool
=======
        return false;
    }
    /**
     * Get the total count of objects in the container
     *
     * @return integer|boolean
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
     */
    public function getObjectCount()
    {
        $data = $this->getInfo();
        if (isset($data['count'])) {
            return $data['count'];
        }
<<<<<<< HEAD

        return false;
    }

    /**
     * Return true if the container is CDN enabled
     *
     * @return bool
=======
        return false;
    }
    /**
     * Return true if the container is CDN enabled
     * 
     * @return boolean
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
     */
    public function isCdnEnabled()
    {
        $data = $this->getCdnInfo();
        if (isset($data['cdn_enabled'])) {
            return $data['cdn_enabled'];
        }
<<<<<<< HEAD

        return false;
    }

    /**
     * Get the TTL of the CDN
     *
     * @return integer|bool
     */
    public function getCdnTtl()
    {
        $data = $this->getCdnInfo();
        if (isset($data['ttl'])) {
            return $data['ttl'];
        }

        return false;
    }

    /**
     * Return true if the log retention is enabled for the CDN
     *
     * @return bool
=======
        return false;
    }
    /**
     * Get the TTL of the CDN
     * 
     * @return integer|boolean 
     */
    public function getCdnTtl() 
    {
        $data = $this->getCdnInfo();
        if (!isset($data['ttl'])) {
            return $data['ttl'];
        }
        return false;
    }
    /**
     * Return true if the log retention is enabled for the CDN
     *
     * @return boolean
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
     */
    public function isCdnLogEnabled()
    {
        $data = $this->getCdnInfo();
<<<<<<< HEAD
        if (isset($data['log_retention'])) {
            return $data['log_retention'];
        }

        return false;
    }

    /**
     * Get the CDN URI
     *
     * @return string|bool
=======
        if (!isset($data['log_retention'])) {
            return $data['log_retention'];
        }
        return false;
    }
    /**
     * Get the CDN URI
     * 
     * @return string|boolean
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
     */
    public function getCdnUri()
    {
        $data = $this->getCdnInfo();
<<<<<<< HEAD
        if (isset($data['cdn_uri'])) {
            return $data['cdn_uri'];
        }

        return false;
    }

    /**
     * Get the CDN URI SSL
     *
     * @return string|bool
=======
        if (!isset($data['cdn_uri'])) {
            return $data['cdn_uri'];
        }
        return false;
    }
    /**
     * Get the CDN URI SSL
     *
     * @return string|boolean
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
     */
    public function getCdnUriSsl()
    {
        $data = $this->getCdnInfo();
<<<<<<< HEAD
        if (isset($data['cdn_uri_ssl'])) {
            return $data['cdn_uri_ssl'];
        }

        return false;
    }

=======
        if (!isset($data['cdn_uri_ssl'])) {
            return $data['cdn_uri_ssl'];
        }
        return false;
    }
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
    /**
     * Get the metadata of the container
     *
     * If $key is empty return the array of metadata
     *
     * @param string $key
<<<<<<< HEAD
     *
     * @return array|string|bool
     */
    public function getMetadata($key = null)
=======
     * @return array|string|boolean
     */
    public function getMetadata($key=null)
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
    {
        $result = $this->service->getMetadataContainer($this->getName());
        if (!empty($result) && is_array($result)) {
            if (empty($key)) {
                return $result['metadata'];
            } else {
                if (isset ($result['metadata'][$key])) {
                    return $result['metadata'][$key];
                }
<<<<<<< HEAD
            }
        }

        return false;
    }

    /**
     * Get the information of the container (total of objects, total size)
     *
     * @return array|bool
=======
            }    
        }    
        return false;
    }
    /**
     * Get the information of the container (total of objects, total size)
     * 
     * @return array|boolean 
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
     */
    public function getInfo()
    {
        $result = $this->service->getMetadataContainer($this->getName());
        if (!empty($result) && is_array($result)) {
<<<<<<< HEAD
            return $result;
        }

        return false;
    }

=======
           return $result;
        }
        return false;
    }
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
    /**
     * Get all the object of the container
     *
     * @return Zend_Service_Rackspace_Files_ObjectList
     */
    public function getObjects()
    {
        return $this->service->getObjects($this->getName());
    }
<<<<<<< HEAD

    /**
     * Get an object of the container
     *
     * @param string $name
     * @param array  $headers
     *
     * @return Zend_Service_Rackspace_Files_Object|bool
     */
    public function getObject($name, $headers = array())
    {
        return $this->service->getObject($this->getName(), $name, $headers);
    }

=======
    /**
     * Get an object of the container
     * 
     * @param string $name
     * @param array $headers
     * @return Zend_Service_Rackspace_Files_Object|boolean
     */
    public function getObject($name, $headers=array())
    {
        return $this->service->getObject($this->getName(), $name, $headers);
    }
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
    /**
     * Add an object in the container
     *
     * @param string $name
     * @param string $file the content of the object
<<<<<<< HEAD
     * @param array  $metadata
     *
     * @return bool
     */
    public function addObject($name, $file, $metadata = array())
    {
        return $this->service->storeObject(
            $this->getName(), $name, $file, $metadata
        );
    }

=======
     * @param array $metadata
     * @return boolen
     */
    public function addObject($name, $file, $metadata=array())
    {
        return $this->service->storeObject($this->getName(), $name, $file, $metadata);
    }
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
    /**
     * Delete an object in the container
     *
     * @param string $obj
<<<<<<< HEAD
     *
     * @return bool
=======
     * @return boolean
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
     */
    public function deleteObject($obj)
    {
        return $this->service->deleteObject($this->getName(), $obj);
    }
<<<<<<< HEAD

=======
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
    /**
     * Copy an object to another container
     *
     * @param string $obj_source
     * @param string $container_dest
     * @param string $obj_dest
<<<<<<< HEAD
     * @param array  $metadata
     * @param string $content_type
     *
     * @return bool
     */
    public function copyObject(
        $obj_source, $container_dest, $obj_dest, $metadata = array(),
        $content_type = null
    )
    {
        return $this->service->copyObject(
            $this->getName(),
            $obj_source,
            $container_dest,
            $obj_dest,
            $metadata,
            $content_type
        );
    }

=======
     * @param array $metadata
     * @param string $content_type
     * @return boolean
     */
    public function copyObject($obj_source, $container_dest, $obj_dest, $metadata=array(), $content_type=null)
    {
        return $this->service->copyObject($this->getName(), $obj_source, $container_dest, $obj_dest, $metadata, $content_type);
    }
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
    /**
     * Get the metadata of an object in the container
     *
     * @param string $object
<<<<<<< HEAD
     *
=======
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
     * @return array
     */
    public function getMetadataObject($object)
    {
<<<<<<< HEAD
        return $this->service->getMetadataObject($this->getName(), $object);
    }

=======
        return $this->service->getMetadataObject($this->getName(),$object);
    }
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
    /**
     * Set the metadata of an object in the container
     *
     * @param string $object
<<<<<<< HEAD
     * @param array  $metadata
     *
     * @return bool
     */
    public function setMetadataObject($object, $metadata = array())
    {
        return $this->service->setMetadataObject(
            $this->getName(), $object, $metadata
        );
    }

=======
     * @param array $metadata
     * @return boolean
     */
    public function setMetadataObject($object,$metadata=array()) 
    {
        return $this->service->setMetadataObject($this->getName(),$object,$metadata);
    }
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
    /**
     * Enable the CDN for the container
     *
     * @param integer $ttl
<<<<<<< HEAD
     *
     * @return array|bool
     */
    public function enableCdn($ttl = Zend_Service_Rackspace_Files::CDN_TTL_MIN)
    {
        return $this->service->enableCdnContainer($this->getName(), $ttl);
    }

    /**
     * Disable the CDN for the container
     *
     * @return bool
     */
    public function disableCdn()
    {
        $result =
            $this->service->updateCdnContainer($this->getName(), null, false);

        return ($result !== false);
    }

=======
     * @return array|boolean
     */
    public function enableCdn($ttl=Zend_Service_Rackspace_Files::CDN_TTL_MIN) 
    {
        return $this->service->enableCdnContainer($this->getName(),$ttl);
    }
    /**
     * Disable the CDN for the container
     * 
     * @return boolean
     */
    public function disableCdn() 
    {
        $result = $this->service->updateCdnContainer($this->getName(),null,false);
        return ($result!==false);
    }
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
    /**
     * Change the TTL for the CDN container
     *
     * @param integer $ttl
<<<<<<< HEAD
     *
     * @return bool
     */
    public function changeTtlCdn($ttl)
    {
        $result = $this->service->updateCdnContainer($this->getName(), $ttl);

        return ($result !== false);
    }

    /**
     * Enable the log retention for the CDN
     *
     * @return bool
     */
    public function enableLogCdn()
    {
        $result = $this->service->updateCdnContainer(
            $this->getName(), null, null, true
        );

        return ($result !== false);
    }

    /**
     * Disable the log retention for the CDN
     *
     * @return bool
     */
    public function disableLogCdn()
    {
        $result = $this->service->updateCdnContainer(
            $this->getName(), null, null, false
        );

        return ($result !== false);
    }

    /**
     * Get the CDN information
     *
     * @return array|bool
     */
    public function getCdnInfo()
    {
        return $this->service->getInfoCdnContainer($this->getName());
    }
}
=======
     * @return boolean
     */
    public function changeTtlCdn($ttl) 
    {
        $result =  $this->service->updateCdnContainer($this->getName(),$ttl);
        return ($result!==false);
    }
    /**
     * Enable the log retention for the CDN
     *
     * @return boolean
     */
    public function enableLogCdn() 
    {
        $result =  $this->service->updateCdnContainer($this->getName(),null,null,true);
        return ($result!==false);
    }
    /**
     * Disable the log retention for the CDN
     *
     * @return boolean
     */
    public function disableLogCdn() 
    {
        $result =  $this->service->updateCdnContainer($this->getName(),null,null,false);
        return ($result!==false);
    }
    /**
     * Get the CDN information
     *
     * @return array|boolean
     */
    public function getCdnInfo() 
    {
        return $this->service->getInfoCdnContainer($this->getName());
    }
}
>>>>>>> b22d39626ae65c380360f646196dad1e164aa76f
