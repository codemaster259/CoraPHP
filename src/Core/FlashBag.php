<?php

namespace Core;

class FlashBag{
    
    public function __construct()
    {
        if(!isset($_SESSION['FLASH_VARS']))
        {
            $_SESSION['FLASH_VARS'] = array();
        }
    }
    
    public function get($key, $def)
    {
        $value = isset($_SESSION['FLASH_VARS'][$key]) ? $_SESSION['FLASH_VARS'][$key] : $def;
        unset($_SESSION['FLASH_VARS'][$key]);
        return $value;
    }
    
    public function set($key, $value)
    {
        $_SESSION['FLASH_VARS'][$key] = $value;
        return $this;
    }
    
    public function pick($key, $def)
    {
        return isset($_SESSION['FLASH_VARS'][$key]) ? $_SESSION['FLASH_VARS'][$key] : $def;
    }
}
