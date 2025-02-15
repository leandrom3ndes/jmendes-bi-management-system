<?php
/**
 * NewDocumentCheckout
 *
 * PHP version 5
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Mayan EDMS API
 *
 * Free Open Source Electronic Document Management System
 *
 * The version of the OpenAPI document: v2
 *
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 4.3.1
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace OpenAPI\Client\Model;

use \ArrayAccess;
use \OpenAPI\Client\ObjectSerializer;

/**
 * NewDocumentCheckout Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class NewDocumentCheckout implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'NewDocumentCheckout';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'block_new_version' => 'bool',
        'document' => 'int',
        'document_pk' => 'int',
        'expiration_datetime' => '\DateTime',
        'id' => 'int'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPIFormats = [
        'block_new_version' => null,
        'document' => null,
        'document_pk' => null,
        'expiration_datetime' => 'date-time',
        'id' => null
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'block_new_version' => 'block_new_version',
        'document' => 'document',
        'document_pk' => 'document_pk',
        'expiration_datetime' => 'expiration_datetime',
        'id' => 'id'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'block_new_version' => 'setBlockNewVersion',
        'document' => 'setDocument',
        'document_pk' => 'setDocumentPk',
        'expiration_datetime' => 'setExpirationDatetime',
        'id' => 'setId'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'block_new_version' => 'getBlockNewVersion',
        'document' => 'getDocument',
        'document_pk' => 'getDocumentPk',
        'expiration_datetime' => 'getExpirationDatetime',
        'id' => 'getId'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }





    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['block_new_version'] = isset($data['block_new_version']) ? $data['block_new_version'] : null;
        $this->container['document'] = isset($data['document']) ? $data['document'] : null;
        $this->container['document_pk'] = isset($data['document_pk']) ? $data['document_pk'] : null;
        $this->container['expiration_datetime'] = isset($data['expiration_datetime']) ? $data['expiration_datetime'] : null;
        $this->container['id'] = isset($data['id']) ? $data['id'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['block_new_version'] === null) {
            $invalidProperties[] = "'block_new_version' can't be null";
        }
        if ($this->container['document_pk'] === null) {
            $invalidProperties[] = "'document_pk' can't be null";
        }
        if ($this->container['expiration_datetime'] === null) {
            $invalidProperties[] = "'expiration_datetime' can't be null";
        }
        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets block_new_version
     *
     * @return bool
     */
    public function getBlockNewVersion()
    {
        return $this->container['block_new_version'];
    }

    /**
     * Sets block_new_version
     *
     * @param bool $block_new_version block_new_version
     *
     * @return $this
     */
    public function setBlockNewVersion($block_new_version)
    {
        $this->container['block_new_version'] = $block_new_version;

        return $this;
    }

    /**
     * Gets document
     *
     * @return int|null
     */
    public function getDocument()
    {
        return $this->container['document'];
    }

    /**
     * Sets document
     *
     * @param int|null $document document
     *
     * @return $this
     */
    public function setDocument($document)
    {
        $this->container['document'] = $document;

        return $this;
    }

    /**
     * Gets document_pk
     *
     * @return int
     */
    public function getDocumentPk()
    {
        return $this->container['document_pk'];
    }

    /**
     * Sets document_pk
     *
     * @param int $document_pk Primary key of the document to be checked out.
     *
     * @return $this
     */
    public function setDocumentPk($document_pk)
    {
        $this->container['document_pk'] = $document_pk;

        return $this;
    }

    /**
     * Gets expiration_datetime
     *
     * @return \DateTime
     */
    public function getExpirationDatetime()
    {
        return $this->container['expiration_datetime'];
    }

    /**
     * Sets expiration_datetime
     *
     * @param \DateTime $expiration_datetime expiration_datetime
     *
     * @return $this
     */
    public function setExpirationDatetime($expiration_datetime)
    {
        $this->container['expiration_datetime'] = $expiration_datetime;

        return $this;
    }

    /**
     * Gets id
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     *
     * @param int|null $id id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->container['id'] = $id;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     *
     * @param integer $offset Offset
     * @param mixed   $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }

    //DISME - Added getter for container for Laravel response purposes in controller
    public function getContainer(){

        return $this->container;

    }

}


