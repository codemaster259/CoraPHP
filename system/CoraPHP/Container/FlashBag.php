<?php

namespace System\CoraPHP\Container;

class FlashBag extends SessionBag{
    
    protected $key = "FLASH_VARS";
    
    public function __construct()
    {
        $this->key = "FLASH_VARS";
        parent::__construct();
    }
    
    public function show($key, $def)
    {
        $val = $this->get($key, $def);
        $this->remove($key);
        return $val;
    }
    
}
