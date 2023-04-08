<?php

namespace App\Http;

class Request
{
    public $uri;
    public $method;
    public $getParams;
    public $postParams;

    public  function __construct()
    {
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->getParams = $this->filterRequest($_GET);
        $this->postParams = $this->filterRequest($_POST);
    }

    protected function filterRequest($request) : array
    {
         return array_map(fn($item) => trim(strip_tags($item)), $request);
    }
}
