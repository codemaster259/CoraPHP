<?php

namespace Main\Controller;

use CoraPHP\Mvc\Controller;
use CoraPHP\Mvc\View;

use CoraPHP\Container\Registry;
/**
 * Controller con template
 */
class TemplateController extends Controller{
    
    protected $template = null;
    
    public function init()
    {
        parent::init();
        $layout = "Common:Layout:blank";
        $this->template = View::make($layout);
        
        if($this->request->isInitial())
        {
            $msg = Registry::channel("Library")->get("Main:Service:MessageService");
            
            $this->template->setFile("Common:Layout:base");
            
            $this->template->add("web_title", Registry::channel("Settings")->get("page_title"))
                ->add("web_http", Registry::channel("Urls")->get("CORE_URL"))
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
