<?php

namespace CoraPHP;

class Loader{
       
    public static $DEFAULT_EXT = ".php";
    
    private static $paths = array();
    
    public static function addPath($path)
    {
        $path = self::FS($path);
        
        self::log("Add Path: {$path}<br><br>");
        
        self::$paths[$path] = $path;
    }
    
    public static function load($className = null)
    {       
        //register
        if(!$className)
        {
            return spl_autoload_register(__METHOD__);
        }
        
        self::log("Search: {$className}<br>");
        
        foreach (self::$paths as $path)
        {
            self::log("Path: {$path}:<br>");
            
            $file = self::FS($path.$className.self::$DEFAULT_EXT);
            
            if(file_exists($file))
            {
                self::log("Existe {$file} !<br><br>");
                require_once $file;
                return true;
            }
        }
        
        self::log("No Existe: {$file}<br><br>");
        return false;
    }
    
    private static function FS($path)
    {
        return str_replace(DIRECTORY_SEPARATOR,"/", $path);
    }
    
    private static $enabled_log = false;
    
    public static function enableLog(){self::$enabled_log = true;}
    public static function disableLog(){self::$enabled_log = false;}
    
    public static function log($log)
    {
        if(self::$enabled_log)
        {
            echo $log;
        }
    }
}

