<?php

/**
 * Created by PhpStorm.
 * Filename: RequestDTO.php
 * @author snowball <snow-snowball@yandex.ru>
 */

namespace Http\Client\Request\DTO;


class RequestDTO
{
    private $endpoint;
    private $path;
    private $pathReplacements;
    private $headers;
    private $query;

    public function __construct(string $endpoint, string $path, array $pathReplacements = [], array $headers = [], array $query = [])
    {
        $this->endpoint = $endpoint;
        $this->path = $path;
        $this->pathReplacements = $pathReplacements;
        $this->headers = $headers;
        $this->query = $query;
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
    public function getPathReplacements(): array
    {
        return $this->pathReplacements;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @return array
     */
    public function getQuery(): array
    {
        return $this->query;
    }

}