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
    
    protected function getTable(){
        return "permisos";
    }
}
