<?php
namespace Darktec\Http;

interface MiddlewareInterface
{
    public function setNext(MiddlewareInterface $handler): MiddlewareInterface;

    public function handle(Request $request);
}