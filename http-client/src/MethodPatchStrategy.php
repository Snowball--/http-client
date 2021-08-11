<?php

/**
 * Created by PhpStorm.
 * Filename: MethodPatchStrategy.php
 * @author snowball <snow-snowball@yandex.ru>
 */

namespace Http\Client;


use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class MethodPatchStrategy implements MethodStrategy
{
    private const METHOD = 'PATCH';

    public function getMethod(): string
    {
        return self::METHOD;
    }

    public function prepareRequest(RequestInterface $request): ResponseInterface
    {
        // TODO: Implement prepareRequest() method.
    }
}