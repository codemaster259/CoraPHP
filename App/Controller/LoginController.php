<?php

namespace App\Controller;

use App\Service\AuthService;

use System\CoraPHP\Mvc\View;

/**
 * LoginController
 */
class LoginController extends TemplateController{
    
    /**
     *
     * @var \System\CoraPHP\Model\EntityManager
     */
    protected $em;
    
    /**
     *
     * @var \App\Service\AuthService
     */
    protected $auth;
    
    public function init(){
        parent::init();
        
        $this->template->setFile("Layout:base.login");
        
        $this->template->append("web_title", "Iniciar Sesion - ");
        
        $this->em = $this->request->injecter->get("EntityManager");
        
        $this->auth = new AuthService($this->em);
    }
    
    public function indexAction(){
        
        if(login_has("login"))
        {
            $this->redirect();
        }
        
        if($this->request->isPost())
        {
            $usuario = trim($this->request->post->get("usuario"));
            $password = trim($this->request->post->get("password"));
            
            if(!$this->auth->login($usuario, $password))
            {
                flash_set("error", $this->auth->getLoginError());
                $this->redirect("/login");
            }
            
            $this->redirect();
        }
        
        $title = "Iniciar Sesion";
        
        $view = View::make("Login:index")
                ->add("page_title", $title);
        
        $this->template->add("web_content", $view);
    }
    
    public function logoutAction(){
        
        if(!login_has("login"))
        {
            $this->redirect("/login");
        }
        
        $this->auth->logout();
        
        $this->redirect();
    }
}
