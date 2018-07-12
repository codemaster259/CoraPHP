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
        
        $this->template->append("web_title", "Iniciar Sesion - ");
        
        $this->em = $this->request->injecter->get("EntityManager");
        
        $this->template->setFile("Layout:base.login");
    }
    
    public function indexAction(){
        
        if($this->request->session->has("login"))
        {
            $this->redirect();
        }
        
        if($this->request->isPost())
        {
            $usuario = trim($this->request->post->get("usuario"));
            $password = trim($this->request->post->get("password"));
            
            $this->auth = new AuthService($this->em);
            
            if(isGod($usuario, $password))
            {
                $this->request->session->set("login", true);
                $this->request->session->set("usuario", "GOD");
                $this->request->session->set("usuario_id", 0);
                $this->request->session->set("is_god", true);
                $this->redirect();
            }
            
            if(!$this->auth->login($usuario, $password))
            {
                $this->request->flash->set("error", $this->auth->getLoginError());
                $this->redirect("/login");
            }
            
            $user = $this->auth->getUser();
        
            $this->request->session->set("login", true);
            $this->request->session->set("usuario", $user->usuario);
            $this->request->session->set("usuario_id", $user->id);
            $this->redirect();
        }
        
        $title = "Iniciar Sesion";
        
        $view = View::make("Login:index")
                ->add("page_title", $title);
        
        $this->template->add("web_content", $view);
    }
    
    public function logoutAction(){
        
        if(!$this->request->session->has("login"))
        {
            $this->redirect("/login");
        }
        
        $this->request->session->remove("login");
        $this->request->session->remove("usuario");
        $this->request->session->remove("usuario_id");
        $this->request->session->remove("is_god");
        $this->redirect();
    }
}
