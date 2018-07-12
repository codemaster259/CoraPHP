<?php

namespace App\Service;

use System\CoraPHP\Model\EntityManager;
use App\Entity\UserEntity;
use App\Entity\RoleEntity;
use App\Entity\PermissionEntity;

/**
 * AuthService
 */
class AuthService{
    
    /**
     *
     * @var EntityManager 
     */
    protected $em;
    protected $loginError;
    protected $usuario;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }
    
    public function getLoginError()
    {
        return $this->loginError;
    }
    
    public function getUser(){
        return $this->usuario;
    }
    
    public function login($usuario, $password)
    {
        $user = new UserEntity();
        $user->usuario = $usuario;
        
        if(trim($usuario) == "")
        {
            $this->loginError = "Usuario en Blanco.";
            return false;
        }
        
        if(!$this->em->findBy($user))
        {
            $this->loginError = "Usuario no Existe.";
            return false;
        }
        
        if($user->password != md5($password))
        {
            $this->loginError = "Password no Coincide.";
            return false;
        }
        $this->usuario = $user;
        return true;
    }
    
    public function isAllowed($user_id, $area, $accion)
    {
        $user = new UserEntity();
        
        $user->id = $user_id;
        
        $role = new RoleEntity();
        
        $permission = new PermissionEntity();
        $permission->area = $area;
        $permission->accion = $accion;
        
        $this->em->getDB();
        
        return true;
    }
}