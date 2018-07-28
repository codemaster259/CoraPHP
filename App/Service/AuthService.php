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
        
        if(isGod($usuario, $password))
        {
            login_set("login", true);
            login_set("usuario", "GOD");
            login_set("usuario_id", 0);
            login_set("is_god", true);
            return true;
        }
        
        $user = new UserEntity();
        $user->usuario = $usuario;
        
        if(trim($usuario) == "")
        {
            $this->loginError = "Usuario en Blanco.";
            return false;
        }
        
        $user = $this->em->findBy($user);
        
        if(!$user)
        {
            $this->loginError = "Usuario no Existe.";
            return false;
        }
        
        debug($user);
        debug(md5($password));
        //die();
        
        if($user->password != md5($password))
        {
            $this->loginError = "Password no Coincide.";
            return false;
        }
        
        login_set("login", true);
        login_set("usuario", $user->usuario);
        login_set("usuario_id", $user->id);
        
        $this->usuario = $user;
        return true;
    }
    
    public function logout()
    {
        login_delete("login");
        login_delete("usuario");
        login_delete("usuario_id");
        login_delete("is_god");
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