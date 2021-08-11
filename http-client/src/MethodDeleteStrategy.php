<?php

/**
 * Created by PhpStorm.
 * Filename: MethodDeleteStrategy.php
 * @author snowball <snow-snowball@yandex.ru>
 */

namespace Http\Client;


use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class MethodDeleteStrategy implements MethodStrategy
{
    private const METHOD = 'DELETE';

    public function getMethod(): string
    {
        return self::METHOD;
    }

    public function prepareRequest(RequestInterface $request): ResponseInterface
    {
        // TODO: Implement prepareRequest() method.
    }
}