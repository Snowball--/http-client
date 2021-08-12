<?php


namespace Http\Client;


use Http\Client\Exception\NotFoundException;
use Psr\Container\ContainerInterface;

/**
 * Class Container
 * @package Http\Client
 */
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

    /**
     * Container constructor.
     */
    private function __construct() {}

    /**
     * @return Container
     */
    public static function getInstance(): Container
    {
        if (!(self::$instance instanceof Container)) {
            self::$instance = new Container();
        }
        return self::$instance;
    }

    /**
     * @param string $id
     * @return mixed
     * @throws NotFoundException
     */
    public function get(string $id)
    {
        if (!isset($this->content[$id])) {
            throw new NotFoundException("");
        }
        return $this->content[$id];
    }

    /**
     * @param string $id
     * @return bool
     */
    public function has(string $id): bool
    {
        return isset($this->content[$id]);
    }

    /**
     * @param string $id
     * @param $value
     */
    public function set(string $id, $value)
    {
        $this->content[$id] = $value;
    }
}