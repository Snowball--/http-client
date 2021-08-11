<?php

/**
 * Created by PhpStorm.
 * Filename: UriBuilder.php
 * @author snowball <snow-snowball@yandex.ru>
 */

namespace Http\Client\Uri;


use Http\Client\Request\DTO\RequestDTO;
use Http\Client\Utils;
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

    public function build(RequestDTO $dto)
    {
        $this->url = $this->factory->createUri($dto->getEndpoint());
        $this->appendPath($dto->getPath(), $dto->getPathReplacements());
        $this->appendQuery($dto->getQuery());

        return $this->url;
    }

    private function appendPath(string $uri, array $params = [])
    {
        $replace = [];
        foreach ($params as $key => $value) {
            $replace[Utils::getPlaceholder($key)] = $value;
        }

        $this->url = $this->url->withPath(strtr($uri, $replace));
    }

    private function appendQuery(array $query = [])
    {
        $this->url = $this->url->withQuery(implode('&', $query));
    }
}