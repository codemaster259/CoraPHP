<?php

namespace Main\Controller;

use Core\View;

class DefaultController extends TemplateController{
    
    public function indexAction()
    {
        $view = View::make("Main:Default:index")
                ->add("page_title", "Home")
                ->add("page_content", "This is Home!");
        
        $this->template->add("web_content", $view);
    }
    
    public function testAction()
    {
        $view = View::make("Main:Default:test")
                ->add("page_title", "Test")
                ->add("page_content", "This is Test!");
                
        
        if($this->request->get->has("id"))
        {
            $id = $this->request->get->get("id");
            $view->add("page_content", "This is Test! and ID: {$id}");
        }
        
        $this->template->add("web_content", $view);
    }
}