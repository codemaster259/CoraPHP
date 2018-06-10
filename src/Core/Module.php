<?php

namespace Core;

abstract class Module{
    
    public abstract function register();
    
    public static function registerModule(Module $module)
    {
        $module->register();
    }
}
