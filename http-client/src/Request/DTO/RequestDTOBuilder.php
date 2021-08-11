<?php

/**
 * Created by PhpStorm.
 * Filename: RequestDTOBuilder.php
 * @author snowball <snow-snowball@yandex.ru>
 */

namespace Http\Client\Request\DTO;


use Http\Client\Exception\InvalidArgumentException;
use Http\Client\Utils;

class RequestDTOBuilder
{
    public function build(string $endpoint, string $path, array $pathReplacements = [], array $headers = [], array $query = [])
    {
        $endpoint = $this->normalizeEndpoint($endpoint);
        $path = $this->normalizePath($path);
        $pathReplacements = $this->normalizePathReplacements($path, $pathReplacements);
        return new RequestDTO($endpoint, $path, $pathReplacements, $headers, $query);
    }

    private function normalizeEndpoint(string $endpoint): string
    {
        return (substr($endpoint, -1) == '/') ? substr_replace($endpoint, '', -1) : $endpoint;
    }

    private function normalizePath(string $path): string
    {
        return (substr($path, 0, 1) == '/') ? $path : '/' . $path;
    }

    private function normalizePathReplacements(string $path, array $pathReplacements): array
    {
        foreach ($pathReplacements as $key => $value) {
            if (strpos($path, Utils::getPlaceholder($key)) == false) {
                throw new InvalidArgumentException("Path hasn't placeholder for parameter {$key}");
            }

            if (is_object($value)) {
                if (!method_exists($value, "__toString")) {
                    throw new InvalidArgumentException("Object passed as parameter must contain toString method");
                }
                $pathReplacements[$key] = $value->__toString();
            }
        }

        return $pathReplacements;
    }
}