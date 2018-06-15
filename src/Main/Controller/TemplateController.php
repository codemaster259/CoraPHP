<?php

namespace Main\Controller;

use CoraPHP\Mvc\Controller;
use CoraPHP\Mvc\View;
/**
 * Controller con template
 */
class TemplateController extends Controller{
    
    protected $template = null;
    
    public function init()
    {
        parent::init();
        $layout = "Shared:Layout:blank";
        $this->template = View::make($layout);
        
        if($this->request->isInitial())
        {
            $msg = $this->bucket->load("Main:Service:MessageService");
            
            $layout = "Shared:Layout:base";
            
            $this->template = View::make($layout)
                ->add("web_title", $this->bucket->get("Settings")["page_title"])
                ->add("web_http", $this->bucket->get("Urls")["CORE_URL"])
                    
                ->add("web_sidebar", $this->fordward("/widget/sidebar"))
                ->add("web_menu", $this->fordward("/widget/menu"))
                ->add("web_msg", $msg->sayRandom());
        }
    }
    
    public function finish()
    {
        parent::finish();
        $this->response->body($this->template);
    }
}
