<?php

namespace Admin\Controller;

use CoraPHP\Mvc\View;

/**
 * DefaultController
 */
class DefaultController extends SecureController{
    
    public function indexAction()
    {
        $view = View::make("Admin:Default:index");
        
        $this->template->add("web_content", $view);
    }
}