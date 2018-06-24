<?php

namespace Common\Controller;

use CoraPHP\Mvc\Controller;

/**
 * No direct access
 */
class PrivateController extends Controller{
    
    public function preInit()
    {
        parent::preInit();
        //block direct access
        if($this->request->isInitial())
        {
            die("Acceso no permitido!");
        }
    }
}