<?php

namespace CoraPHP;

class View{
    public static $DEFAULT_EXT = "php";
    public static $DEFAULT_PATH = "";
    
    private $file = null;
    public $data = array();
    
    public static function make($f, $d = array())
    {
        return new View($f, $d);
    }
    
    public static function loop($f, $d = array())
    {
        $r = "";
        foreach($d as $l)
        {
            $r .= (string) View::make($f, $l);
        }
        return $r;
    }
    
    public function __construct($f, $d = array()) {
        $this->file = $f;
        $this->data = $d;
    }
    
    public function add($k, $v){
        if($v instanceof View)
        {$v = (string) $v;}
        $this->data[$k]=$v;
        return $this;
    }
    
    public function get($key = null, $data = null){
        if(!$key)
        {return $this->data;}
        return isset($this->data[$key]) ? $this->data[$key] : $data;
    }
    
    public function render($file = null){

        if($file){$this->file = $file;}
        
        $mft = explode(":", $this->file);
        
        $module = (trim($mft[0] != "") ? $mft[0]."/" : "");
        $folder = (trim($mft[1] != "") ? $mft[1]."/" : "");
        $template = $mft[2];
        
        $file = self::$DEFAULT_PATH.$module."Views/".$folder.$template.".php";
        
        $output = "Archivo {$file} no existe";
        
        if(file_exists($file))
        {
            $output = self::capture($file, $this->data);
        }
        return $output;
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
    
    public function __toString() {
        return (string) $this->render();
    }
}