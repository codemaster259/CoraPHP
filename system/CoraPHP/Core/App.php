<?php

namespace System\CoraPHP\Core;

class App{
    
    protected static $registry = array();
    
    protected static $EVN_DEV = false;
    
    public function __construct($dev = false){
        
        self::$EVN_DEV = $dev;
    }
    
    protected $things = array();
    
    public function add($name, $thing){
        
        $this->things[$name] = $thing;
    }
    
    public function get($name){
        
        if(isset($this->things[$name]))
        {
            return $this->things[$name];
        }
        
        return null;
    }

    public function onLoad($callback){
        
        $this->on["onLoad"] = $callback;
    }
    
    protected function emit($method){
        
        $on = function(){};
        
        if(isset($this->on[$method]))
        {
            $on = $this->on[$method];
        }
        
        call_user_func_array($on, array($this));
    }
    
    public function load(){
        
        $this->emit("onLoad");
    }
}

