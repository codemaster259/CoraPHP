<?php

namespace Admin\Controller;

use CoraPHP\Mvc\View;

use Common\Controller\TemplateController;

/**
 * DefaultController
 */
class DefaultController extends TemplateController{
    
    public function indexAction()
    {
        $view = View::make("Admin:Default:index");
        
        $this->template->add("web_content", $view);
    }
}