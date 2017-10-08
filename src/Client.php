<?php

namespace AzisHapidin\LaraWhois;

use GuzzleHttp\Client as GuzzleClient;

/**
 * WhoisLookup Client Class
 *
 * @author Azis Hapidin <azishapidin@gmail.com>
 */
class Client
{
    /**
     * Configuration
     * @var array
     */
    protected $config;

    /**
     * Result
     * @var json
     */
    protected $result;

    /**
     * Domain Name
     * @var string
     */
    protected $domainName;

    /**
     * Class Constructor
     * @param string $domainName Required, Domain Name (Example: azishapidin.com)
     * @param array  $config     Optional, Costum Configuration (By default configuration is take from config/larawhois.php)
     */
    public function __construct($domainName = '', $config = [])
    {
        $this->domainName = $domainName;
        $this->createConfig($config);
        $this->takeData();
    }

    /**
     * Create and fill Config Variable
     * @param  array  $config Configuration
     */
    protected function createConfig($config = [])
    {
        if (isset($config['customer_id'])) {
            $this->config['costumer_id'] = $config['costumer_id'];
        } else {
            $this->config['costumer_id'] = config('larawhois.costumer_id');
        }
        if (isset($config['api_key'])) {
            $this->config['api_key'] = $config['api_key'];
        } else {
            $this->config['api_key'] = config('larawhois.api_key');
        }
    }

    /**
     * Get Data from Web Service and Move Result to $this->result
     */
    protected function takeData()
    {
        $client = new GuzzleClient();
        $costumerId = $this->config['costumer_id'];
        $apiKey = $this->config['api_key'];
        $requestUrl = 'https://jsonwhoisapi.com/api/v1/whois';
        $requestUrl .= '?identifier=' . $this->domainName;

        $response = $client->request('GET', $requestUrl, [
            'auth' => [$costumerId, $apiKey]
        ]);

        if ($response->getStatusCode() == 200) {
            $this->result = (string) $response->getBody();
        }
    }

    /**
     * Get Result and Convert it to PHP Object
     * @return object Object Result
     */
    public function getObject()
    {
        if (is_null($this->result)) {
            return null;
        }
        return json_decode($this->result);
    }

    /**
     * Get Result and Convert it to JSON
     * @return string JSON Result
     */
    public function getJson()
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
    public function getArray()
    {
        if (is_null($this->result)) {
            return null;
        }
        return json_decode($this->result, true);
    }
}
