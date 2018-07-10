<?php

namespace App\Controller;

use System\CoraPHP\Mvc\View;

/**
 * LoginController
 */
class LoginController extends TemplateController{
    
    public function indexAction(){
        
        if($this->request->session->has("login"))
        {
            $this->redirect();
        }
        
        if($this->request->isPost())
        {
            $this->request->session->set("login", true);
            $this->request->session->set("usuario", $this->request->post->get("usuario"));
            $this->redirect();
        }
        
        $title = "Login";
        
        $view = View::make("Login:index")
                ->add("page_title", $title);
        
        $this->template->add("web_content", $view);
    }
    
    public function logoutAction(){
        
        if(!$this->request->session->has("login"))
        {
            $this->redirect("login");
        }
        
        $this->request->session->remove("login");
        $this->request->session->remove("usuario");
        $this->redirect();
    }
}