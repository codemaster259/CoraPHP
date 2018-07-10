<?php

namespace App\Entity;

use System\CoraPHP\Model\ActiveRecord;

/**
 * UserEntity
 */
class UserEntity extends ActiveRecord{

    public $usuario;
    public $password;
    public $nombre;
    public $apellido;
    public $email;
    
    protected function getTable(){
        return "usuarios";
    }
}
