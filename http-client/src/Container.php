<?php


namespace Http\Client;


use DI\NotFoundException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class Container implements ContainerInterface
{
    /**
     * @var Container
     */
    private static $instance;

    /**
     * @var array
     */
    private array $content;

    private function __construct() {}

    public static function getInstance(): Container
    {
        if (!(self::$instance instanceof Container)) {
            self::$instance = new Container();
        }
        return self::$instance;
    }

    public function get(string $id)
    {
        if (!isset($this->content[$id])) {
            throw new NotFoundException("");
        }
        return $this->content[$id];
    }

    public function has(string $id): bool
    {
        return isset($this->content[$id]);
    }

    public function set(string $id, $value)
    {
        $this->content[$id] = $value;
    }
}