<?php

namespace App\Http\Controllers;

class ErrorController
{
    public function notFound() 
    {
        require_once APP_ROOT . '/views/404.php';
    }

}