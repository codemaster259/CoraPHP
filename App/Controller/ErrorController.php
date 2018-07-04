<?php

namespace App\Controller;

use System\CoraPHP\Mvc\Controller;

class ErrorController extends Controller{
    
    public function errorAction()
    {
        $error = $this->request->attributes->get('_error');
        $this->response->body($error);
    }
}