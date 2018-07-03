<?php

namespace System\CoraPHP\Core;

class FileSystem{
       
    public static $DEFAULT_EXT = "php";
    
    private static $paths = array();
    
    public static function addPath($path)
    {
        Logger::getLogger(get_called_class())->info("Add Path: {$path}<br><br>");
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
    
    public static function findFile($filename, $ext = ".php", $absolute = false)
    {
        self::log("Search: {$filename}<br>");
        
        $fullfile = $filename.$ext;
        
        if($absolute)
        {
            if(file_exists($fullfile))
            {
                self::log("Existe {$fullfile} !<br><br>");
                return $fullfile;
            }
        }else{
            foreach (self::$paths as $path)
            {
                self::log("Path: {$path}:<br>");

                $file = self::FS($path.$fullfile);

                if(file_exists($file))
                {
                    self::log("Existe {$file} !<br><br>");
                    return $file;
                }
            }
        
        }

        self::log("No Existe: {$fullfile} <br><br>");
        return false;
    }
    
    public static function capture($file, $data, $callback = null)
    {
        $output = (string)call_user_func_array(function(){
            extract(func_get_arg(1));
            ob_start();
            include(func_get_arg(0));
            return ob_get_clean();
        }, array($file, $data));
        
        if($callback)
        {
            $output = call_user_func_array($callback, array($output));
        }
        
        return $output;
    }
    
    public static function read($file, $callback = null){
        
        $output = file_get_contents($file);
        
        if($callback)
        {
            $output = call_user_func_array($callback, array($output));
        }
        
        return $output;
    }
    
    public static function write($file, $content, $overwrite = false){
        
        try{
            if(!$overwrite)
            {
                if(self::findFile($file, null))
                {
                    echo "file exists $file\n";
                    return false;
                }
            }
            
            $file = fopen($file, "w") or die("Unable to open file!");
            fwrite($file, $content);
            fclose($file);
            
        }catch(\Exception $e){
            echo $e->getMessage();
            return false;
        }
        
        return true;
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
            echo $log."\n";
        }
    }
}