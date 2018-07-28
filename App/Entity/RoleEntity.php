<?php

namespace App\Entity;

use System\CoraPHP\Model\Entity;

/**
 * RoleEntity
 */
class RoleEntity extends Entity{

    public $nombre;
    
    public function getTable(){
        return "roles";
    }
}
