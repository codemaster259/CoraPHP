<?php

namespace App\Controller;

use System\CoraPHP\Mvc\View;

use App\Entity\UserEntity;
/**
 * UserController
 */
class UserController extends TemplateController{
    
    public function indexAction()
    {
        $factory = $this->request->injecter->get("ModelFactory");
        
        /* @var App\Entity\UserEntity $users */
        $users = $factory->create(UserEntity::class);
        
        $title = "Users";
        
        $view = View::make("User:index")
                ->add("page_title", $title)
                ->add("users", $users->getAll());
        
        $this->template->append("web_title", "{$title} - ");
        $this->template->add("web_content", $view);
    } 
    
    public function viewAction()
    {
        $factory = $this->request->injecter->get("ModelFactory");
        
        /** @var App\Entity\UserEntity $users */
        $users = $factory->create(UserEntity::class);
        
        $id = $this->request->get->get("id");
        
        $title = "Users - View";
        
        $view = View::make("User:view")
                ->add("page_title", $title)
                ->add("user", $users->getById($id));
        
        $this->template->append("web_title", "{$title} - ");
        $this->template->add("web_content", $view);
    } 
}
