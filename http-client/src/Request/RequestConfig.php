<?php


namespace Http\Client\Request;

/**
 * Class RequestConfig
 * @package Http\Client\Request
 */
class RequestConfig
{
    /**
     * @var string
     */
    private string $method;

    /**
     * @var string
     */
    private string $endpoint;

    /**
     * @var string
     */
    private string $path;

    /**
     * @var array
     */
    private array $options;

    /**
     * RequestConfig constructor.
     * @param string $method
     * @param string $endpoint
     * @param string $path
     * @param array $options
     */
    public function __construct(string $method,
                                string $endpoint,
                                string $path,
                                array $options = [])
    {
        $this->method = $method;
        $this->endpoint = $endpoint;
        $this->path = $path;
        $this->options = $options;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

}