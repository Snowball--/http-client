<?php


namespace Http\Client\Request;


use Psr\Http\Message\RequestInterface;

class RequestMethodBuilder implements RequestBuilderInterface
{
    private RequestConfig $config;

    public function __construct(RequestConfig $config)
    {
        $this->config = $config;
    }

    public function modify(RequestInterface $request): RequestInterface
    {
        return $request->withMethod($this->config->getMethod());
    }
}