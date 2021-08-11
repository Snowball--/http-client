<?php

/**
 * Created by PhpStorm.
 * Filename: Toolkit.php
 * @author snowball <snow-snowball@yandex.ru>
 */

namespace Http\Client;


class Toolkit
{
    private static $instances = [];

    private function __construct()
    {
    }

    public static function set($key, $value)
    {
        self::$instances[$key] = $value;
    }

    public static function get($key)
    {
        if (!empty(self::$instances[$key])) {
            return self::$instances[$key];
        }

        throw new \RuntimeException("Try to get undefined instance {$key}");
    }
}