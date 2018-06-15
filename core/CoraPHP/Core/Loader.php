<?php

namespace CoraPHP\Core;

class Loader{
       
    public static $DEFAULT_EXT = "php";
    
    private static $paths = array();
    
    public static function addPath($path)
    {
        self::log("Add Path: {$path}<br><br>");
        self::$paths[$path] = self::FS($path);
    }
    
    public static function load($className = null)
    {       
        //register
        if(!$className){return spl_autoload_register(__METHOD__);}
        

        $file = self::findFile($className);

        if($file)
        {
            require_once $file;
            return true;
        }
        
        self::log("No Existe: {$file}<br><br>");
        return false;
    }
    
    public static function findFile($filename, $ext = "php", $absolute = false)
    {
        self::log("Search: {$filename}<br>");
        
        if($absolute)
        {
            if(file_exists($filename.".".$ext))
            {
                self::log("Existe {$filename}.{$ext} !<br><br>");
                return $filename.".".$ext;
            }
        }else{
            foreach (self::$paths as $path)
            {
                self::log("Path: {$path}:<br>");

                $file = self::FS($path.$filename.".".$ext);

                if(file_exists($file))
                {
                    self::log("Existe {$file} !<br><br>");
                    return $file;
                }
            }
        
        }

        self::log("No Existe: {$file}<br><br>");
        return false;
    }
    
    public static function capture($file, $data)
    {
        return (string)call_user_func_array(function(){
            extract(func_get_arg(1));
            ob_start();
            include(func_get_arg(0));
            return ob_get_clean();
        }, array($file, $data));
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