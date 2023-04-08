<?php

namespace App\Http;

class Router {

    public $uri;
    public $method;
    public $routeParameters;
    public $controller;
    public $action;
    
    public function __construct() {
        $request = new Request();
        $this->uri = $this->sanitizeURI($request->uri);
        $this->method = $request->method;
        $this->setRouteParameters();
    }

    private function sanitizeURI($uri) {
        return trim(strip_tags($uri));
    }

    public function setRouteParameters() {
        $routeArray = explode("?", $this->uri);
        $this->routeParameters = explode("/", $routeArray[0]);
        $this->setController();
        $this->setAction();
    }

    public function setController() {
        if (isset($this->routeParameters[1])) {
            $this->controller = $this->routeParameters[1];
        }
    }

    public function setAction() {
        if (isset($this->routeParameters[2])) {
            $this->action = $this->routeParameters[2];
        }
    }
}