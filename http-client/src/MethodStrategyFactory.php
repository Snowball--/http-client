<?php

/**
 * Created by PhpStorm.
 * Filename: MethodStrategyFactory.php
 * @author snowball <snow-snowball@yandex.ru>
 */

namespace Http\Client;


use Http\Client\Exception\InvalidArgumentException;

class MethodStrategyFactory
{
    private static $instances = [];

    private function __construct()
    {
    }

    public static function getStrategy(string $method)
    {
        if (empty(self::$instances[$method])) {
            $classname = 'Http\Client\Method' . ucfirst(strtolower($method)) . 'Strategy';
            if (!class_exists($classname)) {
                throw new InvalidArgumentException("Class " . $classname . " not found");
            }
            self::$instances[$method] = new $classname();
        }

        return self::$instances[$method];
    }
}