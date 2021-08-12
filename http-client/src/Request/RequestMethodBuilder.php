<?php


namespace Http\Client\Request;


use Psr\Http\Message\RequestInterface;

/**
 * Class RequestMethodBuilder
 * @package Http\Client\Request
 */
class RequestMethodBuilder implements RequestBuilderInterface
{
    /**
     * @var RequestConfig
     */
    private RequestConfig $config;

    /**
     * RequestMethodBuilder constructor.
     * @param RequestConfig $config
     */
    public function __construct(RequestConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param RequestInterface $request
     * @return RequestInterface
     */
    public function modify(RequestInterface $request): RequestInterface
    {
        return $request->withMethod($this->config->getMethod());
    }
}