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
        $this->getParams = $_GET;
        $this->postParams = $_POST;
    }
}
