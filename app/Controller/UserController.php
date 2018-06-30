<?php

namespace App\Controller;

use System\CoraPHP\Mvc\View;

use App\Model\User;
/**
 * UserController
 */
class UserController extends TemplateController{
    
    public function indexAction()
    {
        $factory = $this->request->injecter->get("ModelFactory");
        
        /* @var Main\Model\User $users */
        $users = $factory->create(User::class);
        
        $title = "Users";
        
        $view = View::make("App:User:index")
                ->add("page_title", $title)
                ->add("users", $users->getAll());
        
        $this->template->append("web_title", "{$title} - ");
        $this->template->add("web_content", $view);
    } 
    
    public function viewAction()
    {
        $factory = $this->request->injecter->get("ModelFactory");
        
        /** @var Main\Model\User $users */
        $users = $factory->create(User::class);
        
        $id = $this->request->get->get("id");
        
        $title = "Users - View";
        
        $view = View::make("App:User:view")
                ->add("page_title", $title)
                ->add("user", $users->getById($id));
        
        $this->template->append("web_title", "{$title} - ");
        $this->template->add("web_content", $view);
    } 
}
