<?php


namespace App\Http;


interface RequestInterface
{
    public function getRequest(string $name, string $path);
}
