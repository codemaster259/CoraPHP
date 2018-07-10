<?php

namespace System\CoraPHP\Container;

class FlashBag extends SessionBag{

    public function __construct($key)
    {
        parent::__construct($key);
    }
    
    public function show($key, $def)
    {
        $val = $this->get($key, $def);
        $this->remove($key);
        return $val;
    }
    
}
