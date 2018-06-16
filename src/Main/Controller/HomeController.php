<?php

namespace Main\Controller;

use CoraPHP\Mvc\View;

/**
 * HomeController
 */
class HomeController extends TemplateController{
    
    public function indexAction()
    {
        $view = View::make("Main:Home:index")
                ->add("page_title", "Home")
                ->add("page_content", "This is Home!");
        
        $this->template->add("web_content", $view);
    }
    
    public function aboutAction()
    {
        $page['page_title'] = "Lorem Ipsum! ".rand();
        $page['page_content'] = $this->get("Main:Service:MessageService")->lorem();

        $view = View::loop("Common:Shared:page", array($page,$page,$page));
        
        $this->template->add("web_content", $view);
    }    
}
