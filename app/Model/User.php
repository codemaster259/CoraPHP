<?php

namespace App\Model;

use System\CoraPHP\Model\ActiveRecord;

/**
 * Description of User
 *
 * @author Pirulo
 */
class User extends ActiveRecord{

    public $usuario;
    public $password;
    public $nombre;
    public $apellido;
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

    public function save(){
        
        if($this->id != null)
        {
            return $this->db->insert($this->getTable(), get_object_vars($this));
        }else{
            return $this->db->update($this->getTable(), get_object_vars($this), "id = {$this->id}");
        }
    }
}
