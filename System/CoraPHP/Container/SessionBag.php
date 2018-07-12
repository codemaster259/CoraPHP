<?php

namespace System\CoraPHP\Container;

class SessionBag {
    
    protected $key = "SESSION_VARS";
    
    public function __construct($key)
    {
        $this->key = $key;
        
        if(!isset($_SESSION[$this->key]))
        {
            $_SESSION[$this->key] = array();
        }
    }
    
    public function get($key, $def = null)
    {
        return isset($_SESSION[$this->key][$key]) ? $_SESSION[$this->key][$key] : $def;
    }
    
    public function has($key)
    {
        return isset($_SESSION[$this->key][$key]);
    }
    
    public function set($key, $value)
    {
        $_SESSION[$this->key][$key] = $value;
        return $this;
    }
    
    public function remove($key)
    {
        if($this->has($key))
        {
            unset($_SESSION[$this->key][$key]);
        }
        return $this;
    }
    
    public function all()
    {
        return $_SESSION[$this->key];
    }
    
        
    /**
     * Vacia la data
     * @return self
     */
    public function clear()
    {
        $_SESSION[$this->key] = array();
        
        return $this;
    }
}
