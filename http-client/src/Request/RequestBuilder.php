<?php

/**
 * Created by PhpStorm.
 * Filename: RequestBuilder.php
 * @author snowball <snow-snowball@yandex.ru>
 */

namespace Http\Client\Request;

use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriFactoryInterface;

class RequestBuilder
{
    /**
     * @var RequestFactoryInterface
     */
    private RequestFactoryInterface $requestFactory;

    /**
     * @var UriFactoryInterface
     */
    private UriFactoryInterface $uriFactory;

    public function __construct(RequestFactoryInterface $requestFactory, UriFactoryInterface $uriFactory)
    {
        $this->requestFactory = $requestFactory;
        $this->uriFactory = $uriFactory;
    }

    public function build(RequestConfig $requestConfig)
    {
        $uri = $this->uriFactory->createUri($requestConfig->getEndpoint());
        $uri = $uri->withPath($requestConfig->getPath());

        $options = $requestConfig->getOptions();
        if ($query = $options['query']) {
            $uri = $uri->withQuery($query);
        }

        $request = $this->requestFactory->createRequest("", $uri);

        $request = $this->updateRequest($request, new RequestMethodBuilder($requestConfig));
        $request = $this->updateRequest($request, new RequestHeaderBuilder($requestConfig));
        $request = $this->updateRequest($request, new RequestBodyBuilder($requestConfig));

        return $request;
    }

    private function updateRequest(RequestInterface $request, RequestBuilderInterface $builder): RequestInterface
    {
        return $builder->modify($request);
    }
}
//
//
//use Http\Client\MethodStrategy;
//use Http\Client\Request\DTO\RequestDTO;
//use Nyholm\Psr7\Factory\Psr17Factory;
//use Psr\Http\Message\RequestFactoryInterface;
//use Psr\Http\Message\RequestInterface;
//use Psr\Http\Message\UriInterface;
//
//class RequestBuilder
//{
//    /**
//     * @var RequestInterface
//     */
//    private RequestInterface $request;
//
//    /**
//     * @var RequestFactoryInterface
//     */
//    private RequestFactoryInterface $factory;
//
//    /**
//     * @var MethodStrategy
//     */
//    private MethodStrategy $methodStrategy;
//
//    public function __construct(RequestFactoryInterface $factory, MethodStrategy $strategy)
//    {
//        $this->factory = $factory;
//        $this->methodStrategy = $strategy;
//    }
//
//
//    public function build(RequestDTO $dto, UriInterface $uri): RequestInterface
//    {
//        $this->createRequest($this->methodStrategy->getMethod(), $uri);
//        $this->appendHeaders($dto->getHeaders());
//        return $this->request;
//    }
//
//    private  function createRequest(string $method, UriInterface $uri)
//    {
//        $this->request = $this->factory->createRequest($method, $uri);
//    }
//
//    private function appendHeaders(array $headers)
//    {
//        $request = $this->request;
//        foreach ($headers as $name => $value) {
//            if (is_array($value)) {
//                foreach ($value as $headerValue) {
//                    if ($this->request->hasHeader($name)) {
//                        $request = $request->withAddedHeader($name, $headerValue);
//                    } else {
//                        $request = $request->withHeader($name, $headerValue);
//                    }
//                }
//                continue;
//            }
//            $request = $request->withHeader($name, $value);
//        }
//        $this->request = $request;
//    }
//}