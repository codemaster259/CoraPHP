<?php

namespace Example\Controller;

use CoraPHP\Controller;
use CoraPHP\View;

/**
 * DefaultController
 */
class DefaultController extends Controller{
    
    public function indexAction()
    {
        $this->response->body(View::make("Example:Default:index"));
    }
}