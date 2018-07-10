<?php

namespace System\CoraPHP\Model;

 use System\CoraPHP\Model\Database;

/**
 * Description of ActiveRecord
 *
 * @author Pirulo
 */
abstract class ActiveRecord {
    
    /**
     * @var Database
     */
    protected $db;
    
    public $id;
    
    public function __construct($db){
        
        $this->db = $db;
    }
    
    abstract protected function getTable();
    
    public function fill($data = null){
        
        if($data)
        {
            foreach ($data as $prop => $value)
            {
                if(property_exists($this, $prop))
                {
                    $this->{$prop} = $value;
                }
            }
        }
        
        return $this;
    }
    
    public function makeAll($items){
        
        $list = array();
        
        foreach ($items as $data)
        {
            $list[] = $this->make($data);
        }
        return $list;
    }
    
    /**
     * 
     * @param array $data
     * @return static
     */
    public function make($data = array()){
        
        $me = new static($this->db);
        
        $me->fill($data);
        
        return $me;
    }
    
    /**
     * Return an array containing only public vars
     * 
     * @return array
     */
    protected function getPublicVars(){
        
        return get_object_public_vars($this);
    }
    
    /**
     * Default implementation of <b>getAll</b> method,
     * you can override if you need
     * 
     * @return array
     */
    public function getAll(){

        return $this->makeAll($this->db->selectAll($this->getTable()));
    }

    /**
     * Default implementation of <b>getById</b> method,
     * you can override if you need
     * 
     * @return self
     */
    public function getById($id){
        
        $data = $this->db->selectOne($this->getTable(), "*", "id = {$id}");
        
        if($data)
        {
            return $this->make($data);
        }
        
        return null;
    }
    
    public function getBy($field, $value){
        
        $data = $this->db->selectOne($this->getTable(), "*", "{$field} = '{$value}'");
        
        if($data)
        {
            return $this->make($data);
        }
        
        return null;
    }
    
    /**
     * Default implementation of <b>save</b> method,
     * you can override if you need
     * 
     * @return mixed
     */
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
    
    public function delete(){
        
        if($this->id !== null)
        {
            $this->db->delete($this->getTable(), "id = {$this->id}");
        }
    }
}
