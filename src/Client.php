<?php namespace AzisHapidin\LaraWhois;

use AzisHapidin\LaraWhois\Converter;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;

/**
 * LaraWhois Client Class
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
    }

    /**
     * Get Data from Web Service and Move Result to $this->result
     * 
     * @return mixed
     */
    public function get()
    {
        $client = new GuzzleClient();

        try {
            $response = $client->request('GET', $this->getUri(), $this->getAuthInfo());
            $result = (string) $response->getBody();
            $converter = new Converter($result);

            return $converter;
        } catch (GuzzleException $e) {
            $response = $e->getResponse();

            return $response->getStatusCode();
        }

        return;
    }

    /**
     * Get Authorization Info
     *
     * @return array
     */
    public function getAuthInfo()
    {
        return [
            'auth' => [$this->config['costumer_id'], $this->config['api_key']]
        ];
    }

    /**
     * Get Uri Info
     *
     * @return string
     */
    public function getUri()
    {
        $parameter = [
            'identifier' => $this->domainName
        ];
        $requestUri = 'https://jsonwhoisapi.com/api/v1/whois?' . http_build_query($parameter);

        return $requestUri;
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
}
