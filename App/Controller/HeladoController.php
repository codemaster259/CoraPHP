<?php

namespace App\Controller;

use System\CoraPHP\Mvc\Controller;

/**
 * HeladoController
 */
class HeladoController extends Controller{
    
    public function indexAction()
    {       
        $this->response->body("Hello from ".__METHOD__."!!");
    }
}