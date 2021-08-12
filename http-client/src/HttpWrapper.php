<?php


namespace Http\Client;

use Http\Client\Request\RequestBuilder;
use Http\Client\Request\RequestConfig;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpClient\Psr18Client;

/**
 * Class HttpWrapper
 * @package Http\Client
 */
class HttpWrapper
{
    /**
     * @var Psr18Client
     */
    private Psr18Client $client;

    /**
     * @var array
     */
    private array $options;

    /**
     * @var string
     */
    private string $endpoint;

    private const METHOD_GET = 'GET';
    private const METHOD_POST = 'POST';
    private const METHOD_PUT = 'PUT';
    private const METHOD_PATCH = 'PATCH';
    private const METHOD_DELETE = 'DELETE';

    /**
     * HttpWrapper constructor.
     * @param Psr18Client $client
     * @param string $endpoint
     * @param array $options
     */
    public function __construct(Psr18Client $client, string $endpoint, array $options = [])
    {
        $this->client = $client;
        $this->endpoint = $endpoint;
        $this->options = $options;
    }

    /**
     * @param string $path
     * @param array $options
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     */
    public function get(string $path, array $options = []): ResponseInterface
    {
        $options = array_merge($this->options, $options);
        $request = $this->createRequest(self::METHOD_GET, $path, $options);

        return $this->sendRequest($request);
    }

    /**
     * @param string $path
     * @param array $options
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     */
    public function post(string $path, array $options = []): ResponseInterface
    {
        $options = array_merge($this->options, $options);
        $request = $this->createRequest(self::METHOD_POST, $path, $options);
        return $this->sendRequest($request);
    }

    /**
     * @param string $path
     * @param array $options
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     */
    public function put(string $path, array $options = []): ResponseInterface
    {
        $options = array_merge($this->options, $options);
        $request = $this->createRequest(self::METHOD_PUT, $path, $options);
        return $this->sendRequest($request);
    }

    /**
     * @param string $path
     * @param array $options
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     */
    public function patch(string $path, array $options = []): ResponseInterface
    {
        $options = array_merge($this->options, $options);
        $request = $this->createRequest(self::METHOD_PATCH, $path, $options);
        return $this->sendRequest($request);
    }

    /**
     * @param string $path
     * @param array $options
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     */
    public function delete(string $path, array $options = []): ResponseInterface
    {
        $options = array_merge($this->options, $options);
        $request = $this->createRequest(self::METHOD_DELETE, $path, $options);
        return $this->sendRequest($request);
    }

    /**
     * @param string $method
     * @param string $path
     * @param array $options
     * @return RequestInterface
     */
    private function createRequest(string $method, string $path, array $options): RequestInterface
    {
        $requestConfig = new RequestConfig($method, $this->endpoint, $path, $options);
        $requestBuilder = new RequestBuilder($this->client, $this->client, $this->client);
        return $requestBuilder->build($requestConfig);
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     */
    private function sendRequest(RequestInterface $request): ResponseInterface
    {
        return $this->client->sendRequest($request);
    }
}