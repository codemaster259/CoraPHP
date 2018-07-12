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
     * @var \System\CoraPHP\Model\EntityManager
     */
    protected $em;
    
    public function init()
    {
        parent::init();
        
        $this->template->append("web_title", "Perfil - ");
        
        $this->em = $this->request->injecter->get("EntityManager");
        
        if($this->request->session->has("is_god"))  
        {
            return $this->response->body($this->template->add("web_content","<h2>Modulo desabilitado en 'GOD MODE'.</h2>"));
        }
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
        
        $user = new UserEntity();
        $user->id = $id;
        
        $user = $this->em->findById($user);
        
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
            
            $user = new UserEntity();
            
            $user->id = $id;
        
            $user = $this->em->findById($user);
            
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

                $user->nombre = $nombre;
                $user->apellido = $apellido;
                $user->email = $email;

                if($this->em->update($user))
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

                if($this->em->update($user))
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