<?php

namespace CoraPHP\Container;

class SessionBag{
    
    protected $key = "SESSION_VARS";
    
    public function __construct()
    {
        if(!isset($_SESSION[$this->key]))
        {
            $_SESSION[$this->key] = array();
        }
    }
    
    public function get($key, $def)
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
}
