<?php

namespace App\Entity;

use System\CoraPHP\Model\ActiveRecord;

/**
 * NotaEntity
 */
class NotaEntity extends ActiveRecord{

    
    protected function getTable(){
        return "nota";
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
