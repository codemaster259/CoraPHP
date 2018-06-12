<?php

namespace Main\Controller;

use CoraPHP\View;

/**
 * Partial views
 */
class WidgetController extends PrivateController{
    
    public function sidebarAction()
    {        
        $links = array(
            array('href'=>'//www.google.com','text'=>'Google'),
            array('href'=>'//www.facebook.com','text'=>'Facebook'),
            array('href'=>'//www.youtube.com','text'=>'Youtube')
        );

        $loop = View::loop("Main:Partial:link", $links);
        
        $view = View::make("Main:Shared:page");
        $view->add("page_title", "Sidebar ");
        $view->add("page_content", "<ul>".$loop."</ul>");
        
        $this->response->body($view);
    }
    
    public function menuAction()
    {        
        $view = View::make("Main:Shared:menu")
                ->add("web_title", $this->bucket->get("PAGE_TITLE"));
        
        $this->response->body($view);
    }
}
