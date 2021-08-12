<?php


namespace Http\Client\Request;


use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamFactoryInterface;

class RequestBodyBuilder implements RequestBuilderInterface
{
    private RequestConfig $config;

    private StreamFactoryInterface $streamFactory;

    public function __construct(RequestConfig $config, StreamFactoryInterface $streamFactory)
    {
        $this->config = $config;
        $this->streamFactory = $streamFactory;
    }

    public function modify(RequestInterface $request): RequestInterface
    {
        $options = $this->config->getOptions();
        if (isset($options['body']) && $body = $options['body']) {
            $request = $request->withBody($this->streamFactory->createStream($body));
        }
        return $request;
    }
}