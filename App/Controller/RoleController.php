<?php

namespace App\Controller;

use System\CoraPHP\Mvc\View;

use App\Entity\RoleEntity;

use App\Entity\PermissionEntity;

use App\Service\AccessService;

/**
 * PermissionController
 */
class RoleController extends SecureController{
    
    /**
     *
     * @var \System\CoraPHP\Model\EntityManager
     */
    protected $em;
    
    /**
     * @var \App\Service\AccessService;
     */
    protected $access;
    
    public function init()
    {   
        parent::init();
        
        //handle permisions or implement some filters...
        
        $this->em = $this->request->injecter->get("EntityManager");
        $this->access = new AccessService($this->em);
        
        $this->template->append("web_title", "Roles - ");
        
        $permisos = $this->em->findAll(new PermissionEntity());
        
        if(empty($permisos))
        {
            return $this->template->add("web_content", "<h2>Error</h2>Debe creare un permiso primero.");
        }
    }
    
    public function indexAction()
    {
        $title = "Lista de Roles:";
        
        $view = View::make("Role:index")
                ->add("page_title", $title)
                ->add("roles", $this->em->findAll(new RoleEntity()));
        
        $this->template->add("web_content", $view);
    }
    
    public function viewAction(){
        
        $this->template->add("web_content","Hello from ".__METHOD__."!!");
    }
    
    public function editAction(){
        
        $title = "Editar Rol:";
        
        $view = View::make("Role:edit")
            ->add("page_title", $title);

        $entity = new RoleEntity();
        
        $entity->id = $this->request->params->get("id");
        
        $this->em->findById($entity);

        $permisos = $this->access->getPermissionFor($entity);
        
        if($this->request->isPost())
        {
            $flag = true;
            
            $nombre = trim($this->request->post->get("nombre"));
            $permisos = $this->request->post->get("permisos");
            
            debug($permisos);
            //die();
            
            if($nombre == "")
            {
                $flag = false;
                flash_set("error", "Nombre en Blanco.");
            }
            
            $entity->nombre = $nombre;

            
            $m = new RoleEntity();
            
            $m->nombre = $nombre;
            
            $match = $this->em->findBy($m);

            if($match && $entity->id != $match->id)
            {
                $flag = false;
                flash_set("error", "Rol {$nombre} ya existe.");
            }
            
            if($flag)
            {
                if($this->access->editRole($entity, $permisos))
                {
                    flash_set("success", "Rol Guardado.");
                    $this->redirect("/roles");
                }else{
                    flash_set("error", "Campos en blanco!");
                }
            }
        }
        
        $view->add("rol", $entity);
        $view->add("permisos", $permisos);

        $this->template->add("web_content", $view);
    }
    
    public function createAction(){
        
        $title = "Crear Rol:";
        
        $view = View::make("Role:create")
            ->add("page_title", $title);
        
        $entity = new RoleEntity();
        
        $permisos = $this->em->findAll(new PermissionEntity());
        
        if($this->request->isPost())
        {           
            $flag = true;
            
            $nombre = trim($this->request->post->get("nombre"));
            $permisos = $this->request->post->get("permisos");
            
            if($nombre == "")
            {
                $flag = false;
                flash_set("error", "Nombre en Blanco.");
            }
            
            $m = new RoleEntity();
            
            $m->nombre = $nombre;
            
            $match = $this->em->findBy($m);

            if($match && $entity->id != $match->id)
            {
                $flag = false;
                flash_set("error", "Rol {$nombre} ya existe.");
            }

            $entity->fill(array(
                "nombre"=>$nombre
            ));
            
            
                        
            if($flag)
            {
                if($this->access->createRole($entity, $permisos))
                {
                    flash_set("success", "Permiso Creado.");
                    $this->redirect("/roles");
                }else{
                    flash_set("error", "Error al crear el permiso.");
                }
            }
        }
        
        $view->add("permisos", $permisos);

        $this->template->add("web_content", $view);
    }
    
    public function deleteAction(){
        $entity = new RoleEntity();
        $entity->id = $this->request->params->get("id");
        
        $this->em->delete($entity);
        
        flash_set("success", "Rol Eliminado.");
        $this->redirect("/roles");
    }
}