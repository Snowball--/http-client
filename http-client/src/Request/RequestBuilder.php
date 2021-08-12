<?php

/**
 * Created by PhpStorm.
 * Filename: RequestBuilder.php
 * @author snowball <snow-snowball@yandex.ru>
 */

namespace Http\Client\Request;

use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;

/**
 * Class RequestBuilder
 * @package Http\Client\Request
 */
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

    /**
     * @var StreamFactoryInterface
     */
    private StreamFactoryInterface $streamFactory;

    /**
     * RequestBuilder constructor.
     * @param RequestFactoryInterface $requestFactory
     * @param UriFactoryInterface $uriFactory
     * @param StreamFactoryInterface $streamFactory
     */
    public function __construct(RequestFactoryInterface $requestFactory,
                                UriFactoryInterface $uriFactory,
                                StreamFactoryInterface $streamFactory)
    {
        $this->requestFactory = $requestFactory;
        $this->uriFactory = $uriFactory;
        $this->streamFactory = $streamFactory;
    }

    /**
     * @param RequestConfig $requestConfig
     * @return RequestInterface
     */
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
        $request = $this->updateRequest($request, new RequestBodyBuilder($requestConfig, $this->streamFactory));

        return $request;
    }

    /**
     * @param RequestInterface $request
     * @param RequestBuilderInterface $builder
     * @return RequestInterface
     */
    private function updateRequest(RequestInterface $request, RequestBuilderInterface $builder): RequestInterface
    {
        return $builder->modify($request);
    }
}
