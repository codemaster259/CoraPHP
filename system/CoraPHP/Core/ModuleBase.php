<?php

namespace CoraPHP\Core;

abstract class ModuleBase{
    
    public function __construct() {
        $this->init();
    }
    
    public function init()
    {
        
    }
    
    public static function loadModule($path)
    {
       $handle = scandir($path);
       
       $nop = array(".","..");
       
       foreach($handle as $dir)
       {
           if(!in_array($dir, $nop))
           {
               $filename = $path.$dir."/ini.php";
               if(file_exists($filename))
               {
                   require_once $filename;
               }
           }
       }
    }
}