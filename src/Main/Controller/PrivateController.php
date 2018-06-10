<?php

namespace Main\Controller;

use CoraPHP\Controller;

/**
 * No direct access
 */
class PrivateController extends Controller{
    
    public function init()
    {
        parent::init();
        //block direct access
        if($this->request->isInitial())
        {
            die("Acceso no permitido!");
        }
    }
}