<?php

namespace App\Controller;

use System\CoraPHP\Mvc\View;

use App\Entity\UserEntity;
/**
 * UserController
 */
class UserController extends TemplateController{
    
    public function init(){
        parent::init();
        
        $this->template->append("web_title", "Usuarios - ");
    }
    
    public function indexAction()
    {
        $factory = $this->request->injecter->get("ModelFactory");
        
        /* @var $users \App\Entity\UserEntity */
        $users = $factory->create(UserEntity::class);
        
        $title = "Lista de Usuarios";
        
        $view = View::make("User:index")
                ->add("page_title", $title)
                ->add("users", $users->getAll());
        
        $this->template->add("web_content", $view);
    } 
    
    public function viewAction()
    {
        $factory = $this->request->injecter->get("ModelFactory");
        
        /* @var $users \App\Entity\UserEntity */
        $users = $factory->create(UserEntity::class);
        
        $id = $this->request->get->get("id");
        
        $title = "Ver Usuario";
        
        $view = View::make("User:view")
                ->add("page_title", $title)
                ->add("user", $users->getById($id));
        
        $this->template->add("web_content", $view);
    } 
}
