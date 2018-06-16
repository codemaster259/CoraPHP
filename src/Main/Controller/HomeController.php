<?php

namespace Main\Controller;

use CoraPHP\Mvc\View;
use CoraPHP\Container\Registry;
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
        $msgs = Registry::channel("Library")->get("Main:Service:MessageService");
        
        $page['page_title'] = "Lorem Ipsum! ".rand();
        $page['page_content'] = $msgs->lorem();

        $this->request->flash->set("msg", $msgs->sayRandom());

        $view = View::loop("Common:Shared:page", array($page,$page,$page));
        
        $this->template->add("web_content", $view);
    }    
}
