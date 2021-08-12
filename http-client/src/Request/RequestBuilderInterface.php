<?php


namespace Http\Client\Request;


use Psr\Http\Message\RequestInterface;

/**
 * Interface RequestBuilderInterface
 * @package Http\Client\Request
 */
interface RequestBuilderInterface
{
    /**
     * @param RequestInterface $request
     * @return RequestInterface
     */
    public function modify(RequestInterface $request): RequestInterface;
}