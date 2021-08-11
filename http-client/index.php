<?php

/**
 * Created by PhpStorm.
 * Filename: index.php
 * @author snowball <snow-snowball@yandex.ru>
 */

use Http\Client\ClientWrapper;
use Http\Client\Toolkit;

require_once __DIR__ . '/vendor/autoload.php';

Toolkit::set(ClientWrapper::class, new ClientWrapper(
    new \Symfony\Component\HttpClient\Psr18Client(),
    new \Http\Client\Request\DTO\RequestDTOBuilder(),
    "https://httpbin.org/",
    [
        'Content-type' => 'application/json',
        'Accept' => 'image/png',
    ]
));

/* @var $client ClientWrapper */
$client = Toolkit::get(ClientWrapper::class);
$response = $client->get('image/png', []);
echo file_put_contents('tet.png', $response->getBody()->getContents());


