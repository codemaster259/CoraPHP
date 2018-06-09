<?php

namespace Main\Controller;

use Core\View;

class WidgetController extends PrivateController{
    
    public function sidebarAction()
    {        
        $links = array(
            array('href'=>'//www.google.com','text'=>'Google'),
            array('href'=>'//www.facebook.com','text'=>'Facebook'),
            array('href'=>'//www.youtube.com','text'=>'Youtube')
        );

        $loop = View::loop("Main:Partial:link", $links);
        
        $view = View::make("Main:Default:index");
        $view->add("page_title", "Sidebar ");
        $view->add("page_content", "<ul>".$loop."</ul>");
        
        $this->response->body($view);
    }
    
    public function menuAction()
    {        
        $view = View::make("Main:Shared:menu");        
        $this->response->body($view);
    }
}
