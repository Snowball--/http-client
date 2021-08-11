<?php

/**
 * Created by PhpStorm.
 * Filename: ClientWrapper.php
 * @author snowball <snow-snowball@yandex.ru>
 */

namespace Http\Client;


use Http\Client\Request\DTO\RequestDTO;
use Http\Client\Request\DTO\RequestDTOBuilder;
use Http\Client\Request\RequestBuilder;
use Http\Client\Uri\UriBuilder;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpClient\Psr18Client;

class ClientWrapper
{
    const METHOD_POST = "POST";
    const METHOD_GET = "GET";
    const METHOD_PUT = "PUT";
    const METHOD_PATCH = "PATCH";
    const METHOD_DELETE = "DELETE";

    private $endpoint;
    private $headers;

    private $client;
    /**
     * @var RequestDTOBuilder
     */
    private $dtoBuilder;

    public function __construct(Psr18Client $client, RequestDTOBuilder $dtoBuilder, string $endpoint, array $headers = [])
    {
        $this->client = $client;
        $this->endpoint = $endpoint;
        $this->headers = $headers;
        $this->dtoBuilder = $dtoBuilder;
    }

    public function post(string $path, array $pathReplacements = [], array $headers = [], array $query = []): ResponseInterface
    {
        $dto = $this->getDto($path, $pathReplacements, $headers, $query);
        return $this->sendRequest(self::METHOD_POST, $dto);
    }

    public function get(string $path, array $pathReplacements = [], array $headers = [], array $query = []): ResponseInterface
    {
        $dto = $this->getDto($path, $pathReplacements, $headers, $query);
        return $this->sendRequest(self::METHOD_GET, $dto);
    }

    public function patch(string $path, array $pathReplacements = [], array $headers = [], array $query = []): ResponseInterface
    {
        $dto = $this->getDto($path, $pathReplacements, $headers, $query);
        return $this->sendRequest(self::METHOD_PATCH, $dto);
    }

    public function put(string $path, array $pathReplacements = [], array $headers = [], array $query = []): ResponseInterface
    {
        $dto = $this->getDto($path, $pathReplacements, $headers, $query);
        return $this->sendRequest(self::METHOD_PUT, $dto);
    }

    public function delete(string $path, array $pathReplacements = [], array $headers = [], array $query = []): ResponseInterface
    {
        $dto = $this->getDto($path, $pathReplacements, $headers, $query);
        return $this->sendRequest(self::METHOD_DELETE, $dto);
    }

    private function getDto(string $path, array $pathReplacements = [], array $headers = [], array $query = []): RequestDTO
    {
        return $this->dtoBuilder->build($this->endpoint, $path, $pathReplacements, $headers, $query);
    }

    private function sendRequest($method, RequestDTO $dto): ResponseInterface
    {
        $uriBuilder = new UriBuilder($this->client);
        $requestBuilder = new RequestBuilder($this->client, MethodStrategyFactory::getStrategy($method));

        $uri = $uriBuilder->build($dto);
        $request = $requestBuilder->build($dto, $uri);

        try {
            return $this->client->sendRequest($request);
        } catch (ClientExceptionInterface $e) {
        }
    }


}