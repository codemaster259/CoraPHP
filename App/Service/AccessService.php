<?php

namespace App\Service;

use System\CoraPHP\Model\EntityManager;

use App\Entity\RoleEntity;
use App\Entity\PermissionEntity;

/**
 * AccessService
 */
class AccessService{

    /**
     *
     * @var EntityManager 
     */
    protected $em;
    
    public function __construct(EntityManager $em) {
        $this->em = $em;
    }
    
    public function getPermissionFor(RoleEntity $role)
    {
        
        $role_permisions_matched = array();
        
        $permissions = $this->em->findAll(new PermissionEntity());
        
        $role_permissions =  $this->em->getDB()->selectAll("roles_permisos", "*", array(
            "rol_id" => $role->id
        ));
        
        /* @var $perm PermissionEntity */
        foreach($permissions as $perm)
        {
            /* @var $role_perm PermissionEntity */
            foreach($role_permissions as $role_perm)
            {

                if($perm->id == $role_perm['permiso_id'])
                {
                    $perm->active = true;
                }
            }

            $role_permisions_matched[$perm->id] = $perm;
        }
        
        return $role_permisions_matched;
    }
    
    public function createRole(RoleEntity $role, array $permisions)
    {
        $role_id = $this->em->create($role);
        
        if($role_id)
        {
            
            foreach($permisions as $id => $value)
            {
                $this->em->getDB()->insert("roles_permisos", array(
                    "permiso_id" => $id,
                    "rol_id" => $role_id
                    ));
            }
            return true;
        }
        
        return false;
    }
    
    public function editRole(RoleEntity $role, array $permisions)
    {
        
        echo $role->id;
        
        $update = $this->em->update($role);
        
        if($update)
        {
            $delete = $this->em->getDB()->delete("roles_permisos", array(
                "rol_id" => $role->id
            ));
            
            
            foreach($permisions as $id => $value)
            {
                $this->em->getDB()->insert("roles_permisos", array(
                    "rol_id" => $role->id,
                    "permiso_id" => $id
                ));
            }
            
            return true;
        }
        
        return false;
    }
}