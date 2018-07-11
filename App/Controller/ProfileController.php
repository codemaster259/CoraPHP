<?php

namespace App\Controller;

use System\CoraPHP\Mvc\View;

use App\Entity\UserEntity;

/**
 * ProfileController
 */
class ProfileController extends SecureController{
        /**
     *
     * @var \App\Entity\UserEntity 
     */
    protected $users;
    
    public function init()
    {
        parent::init();
        
        $this->template->append("web_title", "Perfil - ");
        
        $factory = $this->request->injecter->get("ModelFactory");
        
        $this->users = $factory->create(UserEntity::class);
    }
    
    public function indexAction()
    {
        if($this->request->isPost())
        {
            $this->fordward("/perfil/actualizar");
            return;
        }
        
        $title = "Perfil:";
        
        $id = $this->request->session->get("usuario_id");
        
        $user = $this->users->getById($id);
        
        $view = View::make("Profile:index")
                ->add("page_title", $title)
                ->add("user", $user);
        
        $this->template->add("web_content", $view);
    }
    
    public function updateAction()
    {
        if($this->request->isPost())
        {
            $id = $this->request->session->get("usuario_id");
            
            /* @var $user \App\Entity\UserEntity */
            $user = $this->users->getById($id);
            
            if($this->request->post->has("updateprofile"))
            {
                $nombre = trim($this->request->post->get("nombre"));
                $apellido = trim($this->request->post->get("apellido"));
                $email = trim($this->request->post->get("email"));

                $reset = $this->request->post->get("reset");

                if($nombre == "")
                {
                    $this->request->flash->set("error", "Nombre en Blanco.");
                    $this->redirect("/perfil");
                }

                if($apellido == "")
                {
                    $this->request->flash->set("error", "Apellido en Blanco.");
                    $this->redirect("/perfil");
                }

                if($email == "")
                {
                    $this->request->flash->set("error", "Email en Blanco.");
                    $this->redirect("/perfil");
                }

                /* @var $user \App\Entity\UserEntity */
                $user->nombre = $nombre;
                $user->apellido = $apellido;
                $user->email = $email;

                if($user->save())
                {
                    $this->request->flash->set("success", "Perfil Actualizado.");
                }else{
                    $this->request->flash->set("error", "Error...");
                }
                $this->redirect("/perfil");
            }
            
            if($this->request->post->has("changepass"))
            {
                $password = trim($this->request->post->get("password"));
                $password2 = trim($this->request->post->get("password2"));
                
                if($password == "" || $password2 == "")
                {
                    $this->request->flash->set("error2", "Password en Blanco.");
                    $this->redirect("/perfil");
                }
                
                if(md5($password) != md5($password2))
                {
                    $this->request->flash->set("error2", "Password no Coinciden.");
                    $this->redirect("/perfil");
                }
                
                $user->password = md5($password);

                if($user->save())
                {
                    $this->request->flash->set("success2", "Password Cambiado.");
                }else{
                    $this->request->flash->set("error2", "Error...");
                }
                $this->redirect("/perfil");
            }
        }
    }
}