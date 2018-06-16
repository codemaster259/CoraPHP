<?php

namespace Example\Controller;

use CoraPHP\Mvc\Controller;
use CoraPHP\Mvc\View;

/**
 * DefaultController
 */
class DefaultController extends Controller{
    
    public function indexAction()
    {
        $view = View::make("Example:Default:index");
        
        $layout = View::make("Example::layout");
        
        $layout->add("web_content", $view);
        
        $this->response->body($layout);
    }
}