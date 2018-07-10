<?php

namespace App\Controller;

/**
 * RoleController
 */
class RoleController extends SecureController{
    
    public function indexAction()
    {       
        $this->response->body("Hello from ".__METHOD__."!!");
    }
}