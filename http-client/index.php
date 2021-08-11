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
    []
));

/* @var HttpWrapper $wrapper */
$wrapper = $container->get(HttpWrapper::class);
$response = $wrapper->get('get');
var_dump($response->getBody()->getContents());exit();

//Toolkit::set(ClientWrapper::class, new ClientWrapper(
//    new Psr18Client(),
//    new RequestDTOBuilder(),
//    "https://httpbin.org/",
//    [
//        'Accept' => 'application/json',
//    ]
//));
//
///* @var $client ClientWrapper */
//$client = Toolkit::get(ClientWrapper::class);
//$response = $client->get('get', []);
//echo $response->getBody()->getContents();


