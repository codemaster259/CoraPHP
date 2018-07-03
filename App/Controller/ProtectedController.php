<?php

namespace App\Controller;

use System\CoraPHP\Mvc\Controller;

/**
 * ProtectedController: No direct access
 */
class ProtectedController extends Controller{
    
    public function init()
    {
        parent::init();

        if($this->request->isInitial())
        {
            die("Acceso no permitido!");
        }
    }
}