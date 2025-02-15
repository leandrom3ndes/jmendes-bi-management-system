<?php
/**
 * WorkflowTransition
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
 * WorkflowTransition Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class WorkflowTransition implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'WorkflowTransition';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'destination_state' => '\OpenAPI\Client\Model\WorkflowState',
        'id' => 'int',
        'label' => 'string',
        'origin_state' => '\OpenAPI\Client\Model\WorkflowState',
        'url' => 'string',
        'workflow_url' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPIFormats = [
        'destination_state' => null,
        'id' => null,
        'label' => null,
        'origin_state' => null,
        'url' => null,
        'workflow_url' => null
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
        'destination_state' => 'destination_state',
        'id' => 'id',
        'label' => 'label',
        'origin_state' => 'origin_state',
        'url' => 'url',
        'workflow_url' => 'workflow_url'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'destination_state' => 'setDestinationState',
        'id' => 'setId',
        'label' => 'setLabel',
        'origin_state' => 'setOriginState',
        'url' => 'setUrl',
        'workflow_url' => 'setWorkflowUrl'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'destination_state' => 'getDestinationState',
        'id' => 'getId',
        'label' => 'getLabel',
        'origin_state' => 'getOriginState',
        'url' => 'getUrl',
        'workflow_url' => 'getWorkflowUrl'
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
        $this->container['destination_state'] = isset($data['destination_state']) ? $data['destination_state'] : null;
        $this->container['id'] = isset($data['id']) ? $data['id'] : null;
        $this->container['label'] = isset($data['label']) ? $data['label'] : null;
        $this->container['origin_state'] = isset($data['origin_state']) ? $data['origin_state'] : null;
        $this->container['url'] = isset($data['url']) ? $data['url'] : null;
        $this->container['workflow_url'] = isset($data['workflow_url']) ? $data['workflow_url'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['destination_state'] === null) {
            $invalidProperties[] = "'destination_state' can't be null";
        }
        if ($this->container['label'] === null) {
            $invalidProperties[] = "'label' can't be null";
        }
        if ((mb_strlen($this->container['label']) > 255)) {
            $invalidProperties[] = "invalid value for 'label', the character length must be smaller than or equal to 255.";
        }

        if ($this->container['origin_state'] === null) {
            $invalidProperties[] = "'origin_state' can't be null";
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
     * Gets destination_state
     *
     * @return \OpenAPI\Client\Model\WorkflowState
     */
    public function getDestinationState()
    {
        return $this->container['destination_state'];
    }

    /**
     * Sets destination_state
     *
     * @param \OpenAPI\Client\Model\WorkflowState $destination_state destination_state
     *
     * @return $this
     */
    public function setDestinationState($destination_state)
    {
        $this->container['destination_state'] = $destination_state;

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
     * Gets label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->container['label'];
    }

    /**
     * Sets label
     *
     * @param string $label A short text to describe the transition.
     *
     * @return $this
     */
    public function setLabel($label)
    {
        if ((mb_strlen($label) > 255)) {
            throw new \InvalidArgumentException('invalid length for $label when calling WorkflowTransition., must be smaller than or equal to 255.');
        }

        $this->container['label'] = $label;

        return $this;
    }

    /**
     * Gets origin_state
     *
     * @return \OpenAPI\Client\Model\WorkflowState
     */
    public function getOriginState()
    {
        return $this->container['origin_state'];
    }

    /**
     * Sets origin_state
     *
     * @param \OpenAPI\Client\Model\WorkflowState $origin_state origin_state
     *
     * @return $this
     */
    public function setOriginState($origin_state)
    {
        $this->container['origin_state'] = $origin_state;

        return $this;
    }

    /**
     * Gets url
     *
     * @return string|null
     */
    public function getUrl()
    {
        return $this->container['url'];
    }

    /**
     * Sets url
     *
     * @param string|null $url url
     *
     * @return $this
     */
    public function setUrl($url)
    {
        $this->container['url'] = $url;

        return $this;
    }

    /**
     * Gets workflow_url
     *
     * @return string|null
     */
    public function getWorkflowUrl()
    {
        return $this->container['workflow_url'];
    }

    /**
     * Sets workflow_url
     *
     * @param string|null $workflow_url workflow_url
     *
     * @return $this
     */
    public function setWorkflowUrl($workflow_url)
    {
        $this->container['workflow_url'] = $workflow_url;

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


