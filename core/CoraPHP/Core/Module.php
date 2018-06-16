<?php

namespace CoraPHP\Core;

abstract class Module{
    
    public function __construct() {
        $this->init();
    }
    
    public function init()
    {
        
    }
}