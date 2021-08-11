<?php


namespace Http\Client;

use Http\Client\Request\RequestBuilder;
use Http\Client\Request\RequestConfig;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpClient\Psr18Client;

class HttpWrapper
{
    /**
     * @var Psr18Client
     */
    private Psr18Client $client;
    private array $options;
    private string $endpoint;

    private const METHOD_GET = 'GET';
    private const METHOD_POST = 'POST';
    private const METHOD_PUT = 'PUT';
    private const METHOD_PATCH = 'PATCH';
    private const METHOD_DELETE = 'DELETE';

    public function __construct(Psr18Client $client, string $endpoint, array $options = [])
    {
        $this->client = $client;
        $this->endpoint = $endpoint;
        $this->options = $options;
    }

    public function get(string $path, array $options = []): ResponseInterface
    {
        $options = array_merge($this->options, $options);
        $request = $this->createRequest(self::METHOD_GET, $path, $options);
        return $this->sendRequest($request);
    }

    public function post($path, $options): ResponseInterface
    {
        $options = array_merge($this->options, $options);
        $request = $this->createRequest(self::METHOD_POST, $path, $options);
        return $this->sendRequest($request);
    }

    public function put($path, $options): ResponseInterface
    {
        $options = array_merge($this->options, $options);
        $request = $this->createRequest(self::METHOD_PUT, $path, $options);
        return $this->sendRequest($request);
    }

    public function patch($path, $options): ResponseInterface
    {
        $options = array_merge($this->options, $options);
        $request = $this->createRequest(self::METHOD_PATCH, $path, $options);
        return $this->sendRequest($request);
    }

    public function delete($path, $options): ResponseInterface
    {
        $options = array_merge($this->options, $options);
        $request = $this->createRequest(self::METHOD_DELETE, $path, $options);
        return $this->sendRequest($request);
    }

    private function createRequest($method, $path, $options): RequestInterface
    {
        $requestConfig = new RequestConfig($method, $this->endpoint, $path, $options);
        $requestBuilder = new RequestBuilder($this->client, $this->client);
        return $requestBuilder->build($requestConfig);
    }

    private function sendRequest(RequestInterface $request): ResponseInterface
    {
        return $this->client->sendRequest($request);
    }
}