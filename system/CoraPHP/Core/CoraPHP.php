<?php

namespace CoraPHP\Core;

class CoraPHP{
    
    protected static $registry = array();
    
    protected static $EVN_DEV = false;
    
    public function __construct($dev = false) {
        self::$EVN_DEV = $dev;
    }
    
    public function add()
    {
        
    }
}

