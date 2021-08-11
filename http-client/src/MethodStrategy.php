<?php
/**
 * Created by PhpStorm.
 * Filename: MethodStrategy.php
 * @author snowball <snow-snowball@yandex.ru>
 */

namespace Http\Client;


use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface MethodStrategy
{
    public function getMethod(): string;
    public function prepareRequest(RequestInterface $request): ResponseInterface;
}