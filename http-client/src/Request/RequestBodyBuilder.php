<?php


namespace Http\Client\Request;


use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamFactoryInterface;

/**
 * Class RequestBodyBuilder
 * @package Http\Client\Request
 */
class RequestBodyBuilder implements RequestBuilderInterface
{
    /**
     * @var RequestConfig
     */
    private RequestConfig $config;

    /**
     * @var StreamFactoryInterface
     */
    private StreamFactoryInterface $streamFactory;

    /**
     * RequestBodyBuilder constructor.
     * @param RequestConfig $config
     * @param StreamFactoryInterface $streamFactory
     */
    public function __construct(RequestConfig $config, StreamFactoryInterface $streamFactory)
    {
        $this->config = $config;
        $this->streamFactory = $streamFactory;
    }

    /**
     * @param RequestInterface $request
     * @return RequestInterface
     */
    public function modify(RequestInterface $request): RequestInterface
    {
        $options = $this->config->getOptions();
        if (isset($options['body']) && $body = $options['body']) {
            $request = $request->withBody($this->streamFactory->createStream($body));
        }
        return $request;
    }
}