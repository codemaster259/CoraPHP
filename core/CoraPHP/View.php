<?php

namespace CoraPHP;

class View{

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
    
    public function render($temp = null){

        if($temp){$this->file = $temp;}
        
        $mft = explode(":", $this->file);
        
        $module = (trim($mft[0] != "") ? $mft[0]."/" : "");
        $folder = (trim($mft[1] != "") ? $mft[1]."/" : "");
        $template = $mft[2];
        
        $file = Loader::findFile($module."Views/".$folder.$template);
        
        $output = "Archivo {$file} no existe";
        
        if($file)
        {
            $output = Loader::capture($file, $this->data);
        }
        return $output;
    }
    
    public function __toString() {
        return (string) $this->render();
    }
}