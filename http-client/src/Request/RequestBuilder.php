<?php

/**
 * Created by PhpStorm.
 * Filename: RequestBuilder.php
 * @author snowball <snow-snowball@yandex.ru>
 */

namespace Http\Client\Request;


use Http\Client\MethodStrategy;
use Http\Client\Request\DTO\RequestDTO;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;

class RequestBuilder
{
    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var RequestFactoryInterface
     */
    private $factory;

    /**
     * @var MethodStrategy
     */
    private $methodStrategy;

    public function __construct(RequestFactoryInterface $factory, MethodStrategy $strategy)
    {
        $this->factory = $factory;
        $this->methodStrategy = $strategy;
    }


    public function build(RequestDTO $dto, UriInterface $uri): RequestInterface
    {
        $this->createRequest($this->methodStrategy->getMethod(), $uri);
        $this->setHeaders($dto->getHeaders());
        return $this->request;
    }

    private  function createRequest($method, UriInterface $uri)
    {
        $this->request = $this->factory->createRequest($method, $uri);
    }

    private function setHeaders($headers)
    {
        foreach ($headers as $name => $value) {
            $this->request = $this->request->withHeader($name, $value);
        }
    }
}