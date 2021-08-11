<?php


namespace Http\Client\Request;


use Psr\Http\Message\RequestInterface;

interface RequestBuilderInterface
{
    public function modify(RequestInterface $request): RequestInterface;
}