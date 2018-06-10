<?php
namespace Core;

class View{
    public static $DEFAULT_EXT = "php";
    public static $DEFAULT_PATH = "";
    
    private $file = null;
    public $data = array();
    
    static function make($f, $d = array())
    {
        return new View($f, $d);
    }
    
    static function loop($f, $d = array())
    {
        $r = "";
        
        foreach($d as $l)
        {
            $r .= (string) View::make($f, $l);
        }
        
        return $r;
    }
    
    function __construct($f, $d = array()) {
        $this->file = $f;
        $this->data = $d;
    }
    
    function add($k, $v){
        if($v instanceof View)
        {$v = (string) $v;}
        $this->data[$k]=$v;
        return $this;
    }
    
    function get($k = null, $d = null){
        if(!$k)
        {return $this->data;}
        return isset($this->data[$k]) ? $this->data[$k] : $d;
    }
    
    function render($f = null){
        $ren = "";
        if($f){$this->file = $f;}
        
        $mft = explode(":", $this->file);
        
        $module = (trim($mft[0] != "") ? $mft[0]."/" : "");
        $folder = (trim($mft[1] != "") ? $mft[1]."/" : "");
        $template = $mft[2];
        
        $file = self::$DEFAULT_PATH.$module."Views/".$folder.$template.".php";
        
        if(file_exists($file))
        {
            $ren = call_user_func_array(function(){
                extract(func_get_arg(1));
                ob_start();
                include(func_get_arg(0));
                return ob_get_clean();
            }, array($file, $this->data));
            
        }else{
            $ren = "Archivo {$file} no existe";
        }
        return $ren;
    }
    
    function __toString() {
        return (string) $this->render();
    }
}