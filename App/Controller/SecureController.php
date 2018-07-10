<?php

namespace App\Controller;

/**
 * SecureController
 */
class SecureController extends TemplateController{
    
    public function init()
    {
        parent::init();
                
        if(!$this->request->session->has("login"))
        {
            $this->redirect("login");
        }
    }
}