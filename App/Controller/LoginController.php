<?php

namespace App\Controller;

use App\Entity\UserEntity;

use System\CoraPHP\Mvc\View;
use System\CoraPHP\Container\Registry;

/**
 * LoginController
 */
class LoginController extends TemplateController{
    
    /**
     *
     * @var \App\Entity\UserEntity 
     */
    protected $users;
    
    public function init(){
        parent::init();
        
        $this->template->append("web_title", "Iniciar Sesion - ");
        
        $factory = $this->request->injecter->get("ModelFactory");
        
        $this->users = $factory->create(UserEntity::class);
    }
    
    public function indexAction(){
        
        if($this->request->session->has("login"))
        {
            $this->redirect();
        }
        
        if($this->request->isPost())
        {
            $usuario = trim($this->request->post->get("usuario"));
            $password = md5(($this->request->post->get("password")));
            
            //die($password);
            
            $user = $this->users->getBy("usuario", $usuario);
            
            if(!$user)
            {
                $this->request->flash->set("error", "Usuario no Existe.");
                $this->redirect("/login");
            }
            
            if($password != $user->password)
            {
                $this->request->flash->set("error", "Password no Coincide.");
                $this->redirect("/login");
            }
        
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
        $this->redirect();
    }
    
    protected function masterLogin($usuario, $password)
    {
        $user = Registry::channel("Config")->get("god_user");
        $pass = Registry::channel("Config")->get("god_pass");
        
        return ($user == $usuario && $pass == $password);
    }
}
