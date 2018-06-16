<?php

namespace Main\Controller;

use CoraPHP\Mvc\View;
use CoraPHP\Container\Registry;

/**
 * Partial views
 */
class WidgetController extends PrivateController{
    
    public function sidebarAction()
    {
        $links = array(
            array('href'=>'//www.google.com','text'=>'Google'),
            array('href'=>'//www.facebook.com','text'=>'Facebook'),
            array('href'=>'//www.wikipedia.org','text'=>'Wikipedia'),
            array('href'=>'//www.youtube.com','text'=>'Youtube')
        );

        $loop = View::loop("Main:Partial:link", $links);
        
        $view = View::make("Common:Shared:page");
        $view->add("page_title", "Sidebar ");
        $view->add("page_content", "<ul>".$loop."</ul>");
        
        $this->response->body($view);
    }
    
    public function menuAction()
    {
        $view = View::make("Main:Partial:menu")
                ->add("web_title", Registry::channel("Settings")->get("page_title"));
        
        $this->response->body($view);
    }
}
