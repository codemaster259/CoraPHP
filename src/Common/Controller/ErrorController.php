<?php

namespace Common\Controller;

use CoraPHP\Mvc\Controller;

class ErrorController extends Controller{
    
    public function errorAction()
    {
        $error = $this->request->attributes->get('_error');
        $this->response->body($error);
    }
}