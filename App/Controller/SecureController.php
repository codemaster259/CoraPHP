<?php

namespace App\Controller;

/**
 * SecureController
 */
class SecureController extends TemplateController{
    
    public function init()
    {
        parent::init();
                
        if(!login_has("login"))
        {
            $this->redirect("/login");
        }
    }
}