<?php

namespace App\Entity;

use System\CoraPHP\Model\Entity;

/**
 * PermissionEntity
 */
class PermissionEntity extends Entity{

    public $nombre;
    public $area;
    public $accion;
    
    public function getTable(){
        return "permisos";
    }
}
