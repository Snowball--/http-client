<?php

/**
 * Created by PhpStorm.
 * Filename: index.php
 * @author snowball <snow-snowball@yandex.ru>
 */


use Http\Client\Container;
use Http\Client\HttpWrapper;
use Symfony\Component\HttpClient\Psr18Client;

require_once __DIR__ . '/vendor/autoload.php';

$container = Container::getInstance();
$container->set(HttpWrapper::class, new HttpWrapper(
    new Psr18Client(),
    'https://httpbin.org/',
    [
        'headers' => [
            'Accept' => ['application/json']
        ]
    ]
));

/* @var HttpWrapper $wrapper */
$wrapper = $container->get(HttpWrapper::class);
$response = $wrapper->get('/cookies/set', [
    'query' => 'test=blabla'
]);
echo $response->getBody()->getContents();

$response = $wrapper->post('/status/500');
echo $response->getStatusCode();

$response = $wrapper->put('/status/200');
echo $response->getStatusCode();

$response = $wrapper->delete('/status/300');
echo $response->getStatusCode();

$response = $wrapper->patch('/status/400');
echo $response->getStatusCode();


$response = $wrapper->post('/delay/3');