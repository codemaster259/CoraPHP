<?php

namespace Main\Controller;

use Core\Controller;

/**
 * No direct access
 */
class PrivateController extends Controller{
    
    public function init(){
        
        //block direct access
        if($this->request->isInitial())
        {
            die("Acceso no permitido!");
        }
    }
}