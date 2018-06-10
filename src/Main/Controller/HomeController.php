<?php

namespace Main\Controller;

use CoraPHP\View;

/**
 * HomeController
 */
class HomeController extends TemplateController{
    
    public function indexAction()
    {
        $view = View::make("Main:Shared:page")
                ->add("page_title", "Home")
                ->add("page_content", "This is Home!");
        
        $this->template->add("web_content", $view);
    }
    
    public function aboutAction()
    {
        $view = View::make("Main:Shared:page")
                ->add("page_title", "About")
                ->add("page_content", "This is About!");
        
        $this->template->add("web_content", $view);
    }    
}
