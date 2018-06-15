<?php

namespace CoraPHP\Core;

class Logger{
    
    private $name = "";
    
    protected function __construct($name = "Logger") {
        $this->name = $name;
    }
    
    public static function getLogger($name = "Logger")
    {
        return new Logger($name);
    }
    
    private static $log = false;
    
    public static function enabled($bool)
    {
        self::$log = $bool;
    }
 
    public function info($msg)
    {
        self::log("INFO", $this->name, $msg);
    }
    
    public function warn($subject, $msg)
    {
        self::log("WARN", $this->name, $msg);
    }
    
    public function error($subject, $msg)
    {
        self::log("ERROR", $this->name, $msg);
    }
    
    public static function log($state, $subject, $msg)
    {
        if(self::$log)
        {
            echo "[ <i><b>{$state}</b></i> ][ <b>{$subject}</b> ]: <i>$msg</i><br>";
        }
    }
}
