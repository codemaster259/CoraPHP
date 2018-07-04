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
    public $db;
    
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
    
    public function make($data){
        
        $me = new static($this->db);
        
        $me->fill($data);
        
        return $me;
    }
    
    abstract public function getAll();
    
    abstract public function getById($id);
    
    abstract public function save();
    
    abstract protected function getTable();
}