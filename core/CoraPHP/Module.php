<?php

namespace CoraPHP;

class Module{
    
    protected $name = null;
    
    public function __construct($name) {
        $this->name = $name;
    }
    
    public function setBasePath($path)
    {
        
    }
}
