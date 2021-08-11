<?php

/**
 * Created by PhpStorm.
 * Filename: MethodPostStrategy.php
 * @author snowball <snow-snowball@yandex.ru>
 */

namespace Http\Client;


use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class MethodPostStrategy implements MethodStrategy
{

    private const METHOD = 'POST';

    public function getMethod(): string
    {
        return self::METHOD;
    }

    public function prepareRequest(RequestInterface $request): ResponseInterface
    {
        // TODO: Implement prepareRequest() method.
    }
}