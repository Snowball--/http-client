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
