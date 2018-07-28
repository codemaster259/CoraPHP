<?php

namespace App\Controller;

use System\CoraPHP\Mvc\View;

use App\Entity\PermissionEntity;

/**
 * PermissionController
 */
class PermissionController extends SecureController{
    
        /**
     *
     * @var \System\CoraPHP\Model\EntityManager
     */
    protected $em;
    
    public function init()
    {   
        parent::init();
        
        //handle permisions or implement some filters...
        
        $this->em = $this->request->injecter->get("EntityManager");
        
        $this->template->append("web_title", "Permisos - ");
    }
    
    public function indexAction()
    {
        $title = "Lista de Permisos:";
        
        $entity = new PermissionEntity();
        
        $view = View::make("Permission:index")
                ->add("page_title", $title)
                ->add("permisos", $this->em->findAll($entity));
        
        $this->template->add("web_content", $view);
    }
    
    public function viewAction(){
        
        $this->template->add("web_content","Hello from ".__METHOD__."!!");
    }
    
    public function editAction(){
        
        $title = "Editar Permiso:";
        
        $view = View::make("Permission:edit")
            ->add("page_title", $title);

        $entity = new PermissionEntity();
        
        $entity->id = $this->request->params->get("id");
        
        $this->em->findById($entity);
        
        $view->add("permiso", $entity);
        
        if($this->request->isPost())
        {
            $flag = true;
            
            $nombre = trim($this->request->post->get("nombre"));
            $area = trim($this->request->post->get("area"));
            $accion = trim($this->request->post->get("accion"));
            
            if($nombre == "")
            {
                $flag = false;
                flash_set("error", "Nombre en Blanco.");
            }
            
            $entity->nombre = $nombre;
            
            if($area == "")
            {
                $flag = false;
                flash_set("error", "Area en Blanco.");
            }
            
            $entity->area = $area;
                        
            if($accion == "")
            {
                $flag = false;
                flash_set("error", "Accion en Blanco.");
            }
            
            $entity->accion = $accion;
            
            
            $m = new PermissionEntity();
            
            $m->area = $area;
            $m->accion = $accion;
            
            $match = $this->em->findBy($m);

            if($match && $entity->id != $match->id)
            {
                $flag = false;
                flash_set("error", "Permiso Area:Accion ya existe.");
            }
            
            if($flag)
            {
                if($this->em->update($entity))
                {
                    flash_set("success", "Permiso Guardado.");
                    $this->redirect("/permisos");
                }else{
                    flash_set("error", "Campos en blanco!");
                }
            }
        }
        
        $this->template->add("web_content", $view);
    }
    
    public function createAction(){
        
        $title = "Crear Permiso:";
        
        $view = View::make("Permission:create")
            ->add("page_title", $title);
        
        $entity = new PermissionEntity();
        
        if($this->request->isPost())
        {
            $nombre = trim($this->request->post->get("nombre"));
            $area = trim($this->request->post->get("area"));
            $accion = trim($this->request->post->get("accion"));
            
            if($nombre == "")
            {
                flash_set("error", "Nombre en Blanco.");
                $this->redirect("/permisos/crear");
            }
            
            if($area == "")
            {
                flash_set("error", "Area en Blanco.");
                $this->redirect("/permisos/crear");
            }
            
            if($accion == "")
            {
                flash_set("error", "Accion en Blanco.");
                $this->redirect("/permisos/crear");
            }

            $entity->fill(array(
                "nombre"=>$nombre,
                "area"=>$area,
                "accion"=>$accion
            ));

            if($this->em->create($entity))
            {
                flash_set("success", "Permiso Creado.");
            }else{
                flash_set("error", "Error al crear el permiso.");
            }
            $this->redirect("/permisos");
        }

        $this->template->add("web_content", $view);
    }
    
    public function deleteAction(){
        $entity = new PermissionEntity();
        $entity->id = $this->request->params->get("id");
        
        $this->em->delete($entity);
        
        flash_set("success", "Permiso Eliminado.");
        $this->redirect("/permisos");
    }
}