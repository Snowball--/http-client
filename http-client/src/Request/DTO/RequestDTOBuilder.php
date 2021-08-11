<?php

/**
 * Created by PhpStorm.
 * Filename: RequestDTOBuilder.php
 * @author snowball <snow-snowball@yandex.ru>
 */

namespace Http\Client\Request\DTO;


class RequestDTOBuilder
{
    public function build(string $endpoint, string $path, array $pathReplacements = [], array $headers = [], array $query = [])
    {
        return new RequestDTO($endpoint, $path, $pathReplacements, $headers, $query);
    }
}