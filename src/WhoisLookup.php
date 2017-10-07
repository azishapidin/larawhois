<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class WhoisLookup extends Controller
{
    protected $config;
    protected $result;
    protected $domainName;

    public function __construct($domainName = '', $config = [])
    {
        $this->domainName = $domainName;
        $this->createConfig($config);
        $this->takeData();
    }

    protected function createConfig($config = [])
    {
        if (isset($config['customer_id'])) {
            $this->config['costumer_id'] = $config['costumer_id'];
        } else {
            $this->config['costumer_id'] = config('whois-lookup.costumer_id');
        }
        if (isset($config['api_key'])) {
            $this->config['api_key'] = $config['api_key'];
        } else {
            $this->config['api_key '] = config('whois-lookup.api_key');
        }
    }

    protected function takeData()
    {
        $client = new Client();
        $requestUrl = 'https://jsonwhoisapi.com/api/v1/whois';
        $requestUrl .= '?identifier=' . $this->domainName;

        $response = $client->request('GET', $requestUrl, [
            'auth' => ['user', 'pass']
        ]);

        if ($response->getStatusCode() == 200) {
            $this->result = $response->getBody();
        }
    }

    public function getObject()
    {
        if (is_null($this->result)) {
            return null;
        }
        return json_decode($this->result);
    }

    public function getJson()
    {
        if (is_null($this->result)) {
            return null;
        }
        return $this->result;
    }

    public function getArray()
    {
        if (is_null($this->result)) {
            return null;
        }
        return [];
    }
}
