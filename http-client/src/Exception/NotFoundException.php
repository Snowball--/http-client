<?php


namespace Http\Client\Exception;


use Exception;
use Psr\Container\NotFoundExceptionInterface;

/**
 * Class NotFoundException
 * @package Http\Client\Exception
 */
class NotFoundException extends Exception implements NotFoundExceptionInterface
{

}