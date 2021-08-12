<?php


namespace Http\Client\Request;


use Psr\Http\Message\RequestInterface;

/**
 * Class RequestHeaderBuilder
 * @package Http\Client\Request
 */
class RequestHeaderBuilder implements RequestBuilderInterface
{
    /**
     * @var RequestConfig
     */
    private RequestConfig $config;

    /**
     * RequestHeaderBuilder constructor.
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
        $options = $this->config->getOptions();
        if (is_array($options['headers']) && $headers = $options['headers']) {
            foreach ($headers as $headerName => $value) {
                if (is_array($value)) {
                    foreach ($value as $valuePart) {
                        if ($request->hasHeader($headerName)) {
                            $request = $request->withAddedHeader($headerName, $valuePart);
                        } else {
                            $request = $request->withHeader($headerName, $valuePart);
                        }
                    }
                    continue;
                }
                $request = $request->withHeader($headerName, $value);
            }
        }
        return $request;
    }
}