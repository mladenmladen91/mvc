<?php

namespace App\Http;

class Director
{

    public $controller;
    public $action;
    public $errors = false;
    public $router;

    public function __construct()
    {
        $this->router = new Router();
        $this->controller = $this->router->controller;
        $this->action = $this->router->action;
        
        $this->findController();
        $this->findAction();
    }

    public function findController() : void
    {
        if ($this->controller == "") {
            $this->controller = "Address";
        }


        $this->controller = ucfirst($this->controller) . "Controller";

        if ((!class_exists('App\\Http\\Controllers\\' . $this->controller)) &&
            ($this->controller != "AddressController")
        ) {
            $this->errors = true;
            $this->controller = "ErrorController";
            $this->action = "routeError";
        }
    }

    public function findAction() : void
    {

        if ($this->errors != true) {
            $setAction = $this->action;

            if ((method_exists("\\App\\Http\\Controllers\\" . $this->controller, $this->action)) &&
                ($this->action != "")
            ) {
                $this->action = $setAction;
            }

            if ((method_exists("App\\Http\\Controllers\\" . $this->controller, "index")) &&
                ($setAction == "")
            ) {
                $this->action = "index";
            }
            
            if (!method_exists("App\\Http\\Controllers\\" . $this->controller, $this->action)) {
                $this->controller = "ErrorController";
                $this->action = "routeError";
                $this->errors = true;
            }
        }
    }

    public function route() : void
    {
        $ctrl = "App\\Http\\Controllers\\" . $this->controller;
        $ctrl = new $ctrl;
        call_user_func(array($ctrl, $this->action)); // Maybe another class for dispatching?
    }
}
