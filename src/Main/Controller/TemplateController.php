<?php

namespace Main\Controller;

use CoraPHP\Controller;
use CoraPHP\View;
/**
 * Controller con template
 */
class TemplateController extends Controller{
    
    protected $template = null;
    
    public function init()
    {
        parent::init();
        $layout = "Main:Layout:blank";
        $this->template = View::make($layout);
        
        if($this->request->isInitial())
        {
            $msg = $this->bucket->load("Main:Service:MessageService");
            
            $layout = "Main:Layout:base";
            $this->template = View::make($layout)
                ->add("web_title", "My Web")
                ->add("web_sidebar", $this->fordward("/widget/sidebar"))
                ->add("web_menu", $this->fordward("/widget/menu"))
                ->add("web_http", $this->bucket->get("URLS")["CORE_URL"])
                ->add("web_msg", $msg->sayHello());
        }
    }
    
    public function finish()
    {
        parent::finish();
        $this->response->body($this->template);
    }
}