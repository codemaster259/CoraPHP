<?php

namespace App\Entity;

use System\CoraPHP\Model\Entity;

/**
 * RoleEntity
 */
class RoleEntity extends Entity{

    public $nombre;
    
    protected function getTable(){
        return "roles";
    }
}
