<?php

namespace CoraPHP\Core;

class Module{
    
    public static function loadModules($path)
    {
        $path = rtrim($path, "/")."/";
        
        $dots = array(".","..");
        
        $handler = scandir($path);
        
        foreach ($handler as $dir)
        {
            if(!in_array($dir, $dots))
            {
                if($file = Loader::findFile($path.$dir."/ini", "php", true))
                {
                    include_once $file;
                }
            }
        }
    }
}
