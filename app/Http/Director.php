<?php

namespace App\Http;

class Director
{

    public $controller;
    public $action;
    public $parameters;

    public $errors = false;
    public $router;

    public function __construct()
    {
        $this->router = new Router();
        $this->controller = $this->router->controller;
        $this->action = $this->router->action;
        $this->parameters = $this->router->parameters;

        $this->findController();
        $this->findAction();
    }

    public function findController()
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
            $this->action = "notFound";
        }
    }

    public function findAction()
    {

        if ($this->errors != true) {
            $setAction = $this->action;

            if ((method_exists("\\App\\Http\\Controllers\\" . $this->controller, $this->action)) &&
                ($this->action != "")
            ) {
                $this->action = $setAction;
            }

            if ((is_numeric($this->action)) && (method_exists(
                "App\\Http\\Controllers\\" . $this->controller,
                "show"
            ))) {
                $this->action = "show";
                $this->parameters = $setAction; //2nd URI parameter is actually a parameter; not an action/method
            } else if ((method_exists("App\\Http\\Controllers\\" . $this->controller, "index")) &&
                ($setAction == "")
            ) {
                $this->action = "index";
            }
            
            if (!method_exists("App\\Http\\Controllers\\" . $this->controller, $this->action)) {
                $this->controller = "ErrorController";
                $this->action = "notFound";
                $this->errors = true;
            }
        }
    }

    public function route()
    {
        $ctrl = "App\\Http\\Controllers\\" . $this->controller;
        $ctrl = new $ctrl;
        call_user_func(array($ctrl, $this->action), $this->parameters); // Maybe another class for dispatching?
    }
}
