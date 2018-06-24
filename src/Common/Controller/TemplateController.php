<?php

namespace Common\Controller;

use CoraPHP\Mvc\Controller;
use CoraPHP\Mvc\View;

use CoraPHP\Container\Registry;

/**
 * Controller con template
 */
class TemplateController extends Controller{
    
    /** @var View */
    protected $template = null;
    
    public function init()
    {
        parent::init();
        $layout = "Common:Layout:blank";
        $this->template = View::make($layout);
        
        if($this->request->isInitial())
        {
            $this->template->setFile("Common:Layout:base");
            
            $this->template->add("web_title", Registry::channel("Settings")->get("page_title"))
                ->add("web_http", Registry::channel("Urls")->get("CORE_URL"))
                ->add("web_sidebar", $this->fordward("/widget/sidebar"))
                ->add("web_menu", $this->fordward("/widget/menu"));
        }
    }
    
    public function finish()
    {
        parent::finish();
        $this->response->body($this->template);
    }
}
