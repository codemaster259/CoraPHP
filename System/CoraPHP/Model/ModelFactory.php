<?php

namespace System\CoraPHP\Model;

class ModelFactory{
    
    /**
     * @var Database 
     */
    protected $db;
    
    public function __construct(Database $db) {
    
        $this->db = $db;
    }
    
    public function create($className)
    {
        $model = new $className($this->db);
        return $model;
    }
}