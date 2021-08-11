<?php

/**
 * Created by PhpStorm.
 * Filename: MethodGetStrategy.php
 * @author snowball <snow-snowball@yandex.ru>
 */

namespace Http\Client;


use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class MethodGetStrategy implements MethodStrategy
{
    private const METHOD = 'GET';

    public function getMethod(): string
    {
        return self::METHOD;
    }

    public function prepareRequest(RequestInterface $request): ResponseInterface
    {
        // TODO: Implement sendRequest() method.
    }
}