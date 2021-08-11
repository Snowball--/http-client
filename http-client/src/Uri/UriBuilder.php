<?php

/**
 * Created by PhpStorm.
 * Filename: UriBuilder.php
 * @author snowball <snow-snowball@yandex.ru>
 */

namespace Http\Client\Uri;


use Http\Client\Request\DTO\RequestDTO;
use Psr\Http\Message\UriFactoryInterface;
use Psr\Http\Message\UriInterface;

class UriBuilder
{
    /**
     * @var UriInterface
     */
    private $url;

    /**
     * @var UriFactoryInterface
     */
    private $factory;

    public function __construct(UriFactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function build($endpoint, RequestDTO $dto)
    {
        $endpoint = (substr($endpoint, -1) == '/') ? substr_replace($endpoint, '', -1) : $endpoint;
        $this->url = $this->factory->createUri($endpoint);
        $this->appendPath($dto->getPath(), $dto->getPathReplacements());
        $this->appendQuery($dto->getQuery());

        return $this->url;
    }

    private function appendPath(string $uri, array $params = [])
    {
        $uri = (substr($uri, 0, 1) == '/') ? $uri : '/' . $uri;
        $replace = [];
        foreach ($params as $key => $value) {
            $replace['{' . $key . '}'] = $value;
        }

        $this->url = $this->url->withPath(strtr($uri, $replace));
    }

    private function appendQuery(array $query = [])
    {
        $this->url = $this->url->withQuery(implode('&', $query));
    }
}