<?php


namespace Http\Client;


class Utils
{
    public static function getPlaceholder(string $key): string
    {
        return '{' . $key . '}';
    }
}