<?php

namespace App\Entity;

use System\CoraPHP\Model\ActiveRecord;

/**
 * UserEntity
 */
class UserEntity extends ActiveRecord{

    //public $usuario;
    //public $password;
    //public $nombre;
    //public $apellido;
    public $user;
    public $pass;
    public $email;
    
    protected function getTable(){
        return "usuarios";
    }

    public function getAll(){

        return $this->makeAll($this->db->selectAll($this->getTable()));
    }

    public function getById($id){
        
        $r = $this->make($this->db->selectOne($this->getTable(), "*", "id = {$id}"));

        return $r;
    }
    
    public function test(){
        debug($this->getPublicVars());
    }

    public function save(){
        
        $data = $this->getPublicVars();
        
        unset($data['id']);
        
        if($this->id == null)
        {
            return $this->db->insert($this->getTable(), $data);
        }else{
            return $this->db->update($this->getTable(), $data, "id = {$this->id}");
        }
    }
}
