<?php

namespace CoraPHP;

abstract class ActiveRecord{
    
    /**
     *
     * @var \PDO
     */
    protected $pdo = null;
    
    public function __construct(\PDO $adapter)
    {
        $this->pdo = $adapter;
    }
    
    function save()
    {
        
    }
}