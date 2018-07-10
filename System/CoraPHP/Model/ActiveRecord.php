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
    
    public function __construct($db)
    {
        $this->db = $db;
    }
    
    public function fill($data = null)
    {
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
    public function make($data){
        
        $me = new static($this->db);
        
        $me->fill($data);
        
        return $me;
    }
    
    protected function getPublicVars(){
        return get_object_public_vars($this);
    }
    
    abstract public function getAll();
    
    abstract public function getById($id);
    
    abstract public function save();
    
    abstract protected function getTable();
    
    public function delete(){
        
        if($this->id !== null)
        {
            $this->db->delete($this->getTable(), "id = {$this->id}");
        }
    }
}