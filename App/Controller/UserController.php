<?php

namespace App\Controller;

use System\CoraPHP\Mvc\View;

use App\Entity\UserEntity;
/**
 * UserController
 */
class UserController extends SecureController{
    
    /**
     *
     * @var \App\Entity\UserEntity 
     */
    protected $users;
    
    public function init()
    {
        parent::init();
        
        $this->template->append("web_title", "Usuarios - ");
        
        $factory = $this->request->injecter->get("ModelFactory");
        
        $this->users = $factory->create(UserEntity::class);
    }
    
    public function indexAction()
    {
        $title = "Lista de Usuarios:";
        
        $view = View::make("User:index")
                ->add("page_title", $title)
                ->add("users", $this->users->getAll());
        
        $this->template->add("web_content", $view);
    } 
    
    public function viewAction()
    {        
        $id = $this->request->query->get("id");
        
        $title = "Ver Usuario:";
        
        $view = View::make("User:view")
                ->add("page_title", $title)
                ->add("user", $this->users->getById($id));
        
        $this->template->add("web_content", $view);
    } 
    
    public function createAction()
    {
        $title = "Agregar Usuario:";
        
        $view = View::make("User:create")
            ->add("page_title", $title);
        
        
        if($this->request->isPost())
        {            
            $flag = true;
            
            $usuario = trim($this->request->post->get("usuario"));
            $nombre = trim($this->request->post->get("nombre"));
            $apellido = trim($this->request->post->get("apellido"));
            $email = trim($this->request->post->get("email"));
            
            if($usuario == "")
            {
                $this->request->flash->set("error", "Usuario en Blanco.");
                $this->redirect("/usuarios/crear");
            }
            
            if($this->users->getBy("usuario", $usuario))
            {
                $this->request->flash->set("error", "Usuario en ya existe.");
                $this->redirect("/usuarios/crear");
            }
            
            if($nombre == "")
            {
                $this->request->flash->set("error", "Nombre en Blanco.");
                $this->redirect("/usuarios/crear");
            }
            
            if($apellido == "")
            {
                $this->request->flash->set("error", "Apellido en Blanco.");
                $this->redirect("/usuarios/crear");
            }
            
            if($email == "")
            {
                $this->request->flash->set("error", "Email en Blanco.");
                $this->redirect("/usuarios/crear");
            }
            
            /* @var $user \App\Entity\UserEntity */
            $user = $this->users->make(array(
                "usuario"=>$usuario,
                "nombre"=>$nombre,
                "apellido"=>$apellido,
                "email"=>$email,
                "password"=>md5(1234)
            ));
            
            if($user->save())
            {
                $this->redirect("/usuarios");
            }else{
                $view->add("error", "Error al crear el usuario");
            }
        }

        $this->template->add("web_content", $view);
    }
    
    public function editAction()
    {
        $title = "Editar Usuario:";
        
        $view = View::make("User:edit")
            ->add("page_title", $title);
        
        $id = $this->request->query->get("id");
        
        /* @var $user \App\Entity\UserEntity */
        $user = $this->users->getById($id);
        
        if($this->request->isPost())
        {
            debug($this->request->post->all());
            
            $nombre = trim($this->request->post->get("nombre"));
            $apellido = trim($this->request->post->get("apellido"));
            $email = trim($this->request->post->get("email"));
            
            $reset = $this->request->post->get("reset");
            
            if($nombre == "")
            {
                $this->request->flash->set("error", "Nombre en Blanco.");
                $this->redirect("/usuarios/editar/".$id);
            }
            
            if($apellido == "")
            {
                $this->request->flash->set("error", "Apellido en Blanco.");
                $this->redirect("/usuarios/editar/".$id);
            }
            
            if($email == "")
            {
                $this->request->flash->set("error", "Email en Blanco.");
                $this->redirect("/usuarios/editar/".$id);
            }
            
            $user->nombre = $nombre;
            $user->apellido = $apellido;
            $user->email = $email;
            
            if($reset)
            {
                $user->password = md5(1234);
            }
            
            if($user->save())
            {
                $this->redirect("/usuarios");
            }else{
                $view->add("error", "Campos en blanco!");
            }
        }
        
        $view->add("user", $user);
        
        $this->template->add("web_content", $view);
    }
        
    public function deleteAction()
    {        
        $user = $this->users->make(array("id" => $this->request->query->get("id")));
        
        $user->delete();
        
        $this->redirect("/usuarios");
    }
}
