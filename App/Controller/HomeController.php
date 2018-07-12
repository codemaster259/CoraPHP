<?php

namespace App\Controller;

use System\CoraPHP\Mvc\View;

/**
 * HomeController
 */
class HomeController extends SecureController{
    
    public function init(){
        parent::init();
        $this->template->append("web_title", "Inicio - ");
    }
    
    public function indexAction()
    {        
        $this->template->add("web_content", View::make("Home:index"));
    }
}
