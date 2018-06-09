<?php
namespace Core;

class Loader{
    
    public static $DEFAULT_PATH = null;
    public static $DEFAULT_EXT = ".php";
    
    private static $paths = array();
    
    public static function addPath($ns, $path)
    {
        $ns = trim($ns,"\\")."\\";
        
        $path = self::FS($path);
        
        self::log("Add {$ns} for {$path}<br><br>");
        
        self::$paths[$ns] = $path;
    }
    
    private static function match($class)
    {
        $path = "";
        
        $flag = false;
        
        foreach(self::$paths as $ns=>$p)
        {
            self::log("* Test $class: ");
            if(substr($class, 0, strlen($ns)) === $ns)
            {
                self::log("match with {$ns}<br>");
                $flag = true;
                $path = $p;
            }else{
                self::log("no match with {$ns}<br>");
            }
            
            if($flag)
            {
                break;
            }
        }
        
        return $path;
    }
    
    public static function load($className = null)
    {
        if(!self::$DEFAULT_PATH)
        {
            self::$DEFAULT_PATH = self::FS(dirname(dirname(__FILE__)))."/";
        }
        
        //register
        if(!$className)
        {
            return spl_autoload_register(__METHOD__);
        }
        
        self::log("Search: {$className}<br>");
        $folder = self::FS(self::$DEFAULT_PATH);

        $pre = self::match($className);
        
        if($pre != "")
        {
            $folder = $pre;
        }
        
        self::log("Folder: {$folder}:<br>");
        
        $file = self::FS($folder.$className.self::$DEFAULT_EXT);
        
        self::log("File: {$file}<br>");
        
        if(file_exists($file))
        {
            self::log("Existe {$file} !<br><br>");
            require_once $file;
            return true;
        }
        
        self::log("No Existe: {$file}<br><br>");
        
        return false;
    }
    private static function FS($path)
    {
        return str_replace(DIRECTORY_SEPARATOR,"/", $path);

    }
    
    private static $enabled_log = false;
    
    public static function enable(){self::$enabled_log = true;}
    public static function disable(){self::$enabled_log = false;}
    
    public static function log($log)
    {
        if(self::$enabled_log)
        {
            echo $log;
        }
    }
}

