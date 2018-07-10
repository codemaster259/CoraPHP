<?php

namespace App\Entity;

use System\CoraPHP\Model\ActiveRecord;

/**
 * RoleEntity
 */
class RoleEntity extends ActiveRecord{

    
    protected function getTable(){
        return "role";
    }
}
