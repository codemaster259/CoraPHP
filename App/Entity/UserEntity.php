<?php

namespace App\Entity;

use System\CoraPHP\Model\Entity;

/**
 * UserEntity
 */
class UserEntity extends Entity{

    public $usuario;
    public $password;
    public $nombre;
    public $apellido;
    public $email;
    
    public function getTable(){
        return "usuarios";
    }
}
