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
        
        /* @var $users \App\Entity\UserEntity */
        $users = $factory->create(UserEntity::class);
        
        $pirulo = $users->make(array(
            "user"=>"pirulo",
            "pass"=>"pirulop",
            "email"=>"piruloe"
        ));
        
        if($c = $pirulo->save())
        {
            echo "OK<br>";
        }else{
            echo "error: ".$c;
        }
        
        debug($users->getAll());
        
        $title = "Users";
        
        $view = View::make("User:index")
                ->add("page_title", $title)
                ->add("users", array());//$users->getAll());
        
        $this->template->append("web_title", "{$title} - ");
        $this->template->add("web_content", $view);
    } 
    
    public function viewAction()
    {
        $factory = $this->request->injecter->get("ModelFactory");
        
        /* @var $users \App\Entity\UserEntity */
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
