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
     * @var \System\CoraPHP\Model\EntityManager
     */
    protected $em;
    
    public function init()
    {
        parent::init();
        
        $this->template->append("web_title", "Usuarios - ");
        
        $this->em = $this->request->injecter->get("EntityManager");
    }
    
    public function indexAction()
    {
        $title = "Lista de Usuarios:";
        
        $u = new UserEntity();
        
        $view = View::make("User:index")
                ->add("page_title", $title)
                ->add("users", $this->em->findAll($u));
        
        $this->template->add("web_content", $view);
    } 
    
    public function viewAction()
    {        
        $id = $this->request->params->get("id");
        
        $u = new UserEntity();
        $u->id = $id;
        
        $title = "Ver Usuario:";
        
        $view = View::make("User:view")
                ->add("page_title", $title)
                ->add("user", $this->em->findById($u));
        
        $this->template->add("web_content", $view);
    } 
    
    public function createAction()
    {
        $title = "Agregar Usuario:";
        
        $view = View::make("User:create")
            ->add("page_title", $title);
        
        $u = new UserEntity();
        
        if($this->request->isPost())
        {
            $flag = true;
            
            $usuario = trim($this->request->post->get("usuario"));
            $nombre = trim($this->request->post->get("nombre"));
            $apellido = trim($this->request->post->get("apellido"));
            $email = trim($this->request->post->get("email"));
            
            if($usuario == "")
            {
                flash_set("error", "Usuario en Blanco.");
                $this->redirect("/usuarios/crear");
            }
            
            $u->usuario = $usuario;
            
            if($this->em->findBy($u))
            {
                flash_set("error", "Usuario en ya existe.");
                $this->redirect("/usuarios/crear");
            }
            
            if($nombre == "")
            {
                flash_set("error", "Nombre en Blanco.");
                $this->redirect("/usuarios/crear");
            }
            
            if($apellido == "")
            {
                flash_set("error", "Apellido en Blanco.");
                $this->redirect("/usuarios/crear");
            }
            
            if($email == "")
            {
                flash_set("error", "Email en Blanco.");
                $this->redirect("/usuarios/crear");
            }
            
            $user = new UserEntity();
            
            
            /* @var $user \App\Entity\UserEntity */
            $user->fill(array(
                "usuario"=>$usuario,
                "nombre"=>$nombre,
                "apellido"=>$apellido,
                "email"=>$email,
                "password"=>md5("1234")
            ));
            
            if($this->em->create($user))
            {
                flash_set("success", "Usuario Creado.");
            }else{
                flash_set("error", "Error al crear el usuario.");
            }
            $this->redirect("/usuarios");
        }

        $this->template->add("web_content", $view);
    }
    
    public function editAction()
    {
        $title = "Editar Usuario:";
        
        $view = View::make("User:edit")
            ->add("page_title", $title);

        $user = new UserEntity();
        
        $user->id = $this->request->params->get("id");
        
        $user = $this->em->findById($user);
        
        $view->add("user", $user);
        
        if($this->request->isPost())
        {
            $flag = true;
            
            $nombre = trim($this->request->post->get("nombre"));
            $apellido = trim($this->request->post->get("apellido"));
            $email = trim($this->request->post->get("email"));
            
            $reset = $this->request->post->get("reset");
            
            if($nombre == "")
            {
                $flag = false;
                flash_set("error", "Nombre en Blanco.");
                //$this->redirect("/usuarios/editar/".$id);
            }
            
            $user->nombre = $nombre;
            
            if($apellido == "")
            {
                $flag = false;
                flash_set("error", "Apellido en Blanco.");
                //$this->redirect("/usuarios/editar/".$id);
            }
            
            $user->apellido = $apellido;
            
            if($email == "")
            {
                $flag = false;
                flash_set("error", "Email en Blanco.");
                //$this->redirect("/usuarios/editar/".$id);
            }
            
            $user->email = $email;
            
            if($flag)
            {
                if($reset)
                {
                    $user->password = md5("1234");
                }

                if($this->em->update($user))
                {
                    flash_set("success", "Usuario Guardado.");
                    $this->redirect("/usuarios");
                }else{
                    flash_set("error", "Campos en blanco!");
                }
            }
        }
        
        
        
        $this->template->add("web_content", $view);
    }
        
    public function deleteAction()
    {        
        $user = new UserEntity();
        $user->id = $this->request->params->get("id");
        
        $this->em->delete($user);
        
        flash_set("success", "Usuario Eliminado.");
        $this->redirect("/usuarios");
    }
}
