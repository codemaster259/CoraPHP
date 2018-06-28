<?php

namespace Main\Controller;

use CoraPHP\Mvc\View;
use CoraPHP\Container\Registry;

use Common\Controller\TemplateController;
/**
 * HomeController
 */
class HomeController extends TemplateController{
    
    public function indexAction()
    {
        $title = "Home";
        
        $view = View::make("Main:Home:index")
                ->add("page_title", $title)
                ->add("page_content", "This is Home!");
        
        $this->template->append("web_title", "{$title} - ");
        $this->template->add("web_content", $view);
    }
    
    public function mvcAction()
    {
        $title = "This is MVC";
        
        $view = View::make("Main:Home:mvc")
                ->add("page_title", $title);

        $this->template->append("web_title", "{$title} - ");
        $this->template->add("web_content", $view);
    } 
}
