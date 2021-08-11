<?php


namespace Http\Client\Request;


class RequestConfig
{
    private string $method;
    private string $endpoint;
    private string $path;
    private array $options;

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