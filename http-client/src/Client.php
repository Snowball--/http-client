<?php

/**
 * Created by PhpStorm.
 * Filename: Client.php
 * @author snowball <snow-snowball@yandex.ru>
 */

namespace Http\Client;


use Symfony\Component\HttpClient\HttplugClient;
use Symfony\Component\HttpClient\NativeHttpClient;

class Client
{
    const METHOD_POST = "POST";
    const METHOD_GET = "GET";
    const METHOD_PUT = "PUT";
    const METHOD_PATCH = "PATCH";
    const METHOD_DELETE = "DELETE";

    private $endpoint;
    private $headers;

    private $client;

    public function __construct(HttplugClient $client, string $endpoint, array $headers = [])
    {
        $this->client = $client;
        $this->endpoint = $endpoint;
        $this->headers = $headers;
    }

    public function post($uri, $params)
    {
        $this->makeRequest(self::METHOD_POST, $uri, $params);
    }

    public function get($uri, $params)
    {
        $this->makeRequest(self::METHOD_GET, $uri, $params);
    }

    public function patch($uri, $params)
    {
        $this->makeRequest(self::METHOD_PATCH, $uri, $params);
    }

    public function put($uri, $params)
    {
        $this->makeRequest(self::METHOD_PUT, $uri, $params);
    }

    public function delete($uri, $params)
    {
        $this->makeRequest(self::METHOD_DELETE, $uri, $params);
    }

    private function makeRequest($method, $uri, $options)
    {
        $options = array_merge($options, ['headers' => $this->headers]);
        $r = $this->client->createRequest();

        $this->client->sendRequest($r);

    }
}