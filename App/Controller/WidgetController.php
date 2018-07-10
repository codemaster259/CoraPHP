<?php

namespace App\Controller;

use System\CoraPHP\Mvc\View;
use System\CoraPHP\Container\Registry;

/**
 * Partial views
 */
class WidgetController extends ProtectedController{
    
    public function sidebarAction()
    {
        $links = array(
            array('href'=>'//www.google.com','text'=>'Google'),
            array('href'=>'//www.facebook.com','text'=>'Facebook'),
            array('href'=>'//www.wikipedia.org','text'=>'Wikipedia'),
            array('href'=>'//www.youtube.com','text'=>'Youtube')
        );

        $loop = View::loop("Partial:link", $links);
        
        $view = View::make("Shared:page");
        $view->add("page_title", "Sidebar ");
        $view->add("page_content", "<ul>".$loop."</ul>");
        
        $this->response->body($view);
    }
    
    public function menuAction()
    {
        $view = View::make("Shared:menu")
                ->add("web_site", Registry::channel("Settings")->get("web_site"));
        
        $this->response->body($view);
    }
}
