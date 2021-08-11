<?php

/**
 * Created by PhpStorm.
 * Filename: MethodPutStrategy.php
 * @author snowball <snow-snowball@yandex.ru>
 */

namespace Http\Client;


use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class MethodPutStrategy implements MethodStrategy
{

    private const METHOD = 'PUT';

    public function getMethod(): string
    {
        return self::METHOD;
    }

    public function prepareRequest(RequestInterface $request): ResponseInterface
    {
        // TODO: Implement prepareRequest() method.
    }
}