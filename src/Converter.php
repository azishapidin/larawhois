<?php namespace AzisHapidin\LaraWhois;

/**
 * Converter Class
 *
 * @author Azis Hapidin <azishapidin@gmail.com>
 */
class Converter
{
    /**
     * Result
     * @var string
     */
    protected $result;

    /**
     * Constructor
     * @param string $result JSON Result
     */
    public function __construct($result = '')
    {
        $this->result = $result;
    }

    /**
     * Get Result and Convert it to JSON
     * @return string JSON Result
     */
    public function toJson()
    {
        if (is_null($this->result)) {
            return null;
        }
        return $this->result;
    }

    /**
     * Get Result and Convert it to PHP Array
     * @return array PHP Array of Result
     */
    public function toArray()
    {
        if (is_null($this->result)) {
            return null;
        }
        return json_decode($this->result, true);
    }

    /**
     * Get Result and Convert it to PHP Object
     * @return object Object Result
     */
    public function toObject()
    {
        if (is_null($this->result)) {
            return null;
        }
        return json_decode($this->result);
    }
}
