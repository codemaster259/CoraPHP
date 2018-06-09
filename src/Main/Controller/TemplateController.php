<?php

namespace Main\Controller;

use Core\Controller;
use Core\View;

/**
 * Controller con template
 */
class TemplateController extends Controller{
    
    protected $template = null;
    
    public function init()
    {
        $layout = "Main:Layout:blank";
        $this->template = View::make($layout);
        
        if($this->request->isInitial())
        {
            $msg = $this->load("Main:Service:MessageService");
            
            $layout = "Main:Layout:base";
            $this->template = View::make($layout)
                ->add("web_title", "My Web")
                ->add("web_sidebar", $this->fordward("/widget/sidebar"))
                ->add("web_menu", $this->fordward("/widget/menu"))
                ->add("web_msg", $msg->sayHello());
        }
    }
    
    public function finish()
    {
        $this->response->body($this->template);
    }
}