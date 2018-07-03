<?php

namespace System\CoraPHP\Mvc;

use System\CoraPHP\Core\FileSystem;

class View{

    private $file = null;
    private $data = array();
    protected static $shared = array();
    
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
    
    public function __construct($f, $d = array())
    {
        $this->file = $f;
        $this->data = $d;
    }
    
    public function add($k, $v)
    {
        $this->data[$k]=$v;

        return $this;
    }
    
    public function append($k, $v)
    {
        if(isset($this->data[$k]))
        {
            $this->data[$k] = $v.$this->data[$k];
        }
        
        return $this;
    }
    
    public function setFile($f)
    {
        $this->file = $f;
        return $this;
    }
    
    public function shared($key, $val = null)
    {
        self::$shared[$key] = $val;
    }
    
    public function getShared($key)
    {
        return (isset(self::$shared[$key]) ? self::$shared[$key] : null);
    }
    
    public function get($key = null, $data = null)
    {
        if(!$key)
        {
            return $this->data;
        }
        return isset($this->data[$key]) ? $this->data[$key] : $data;
    }
    
    public function render($temp = null)
    {

        if($temp){$this->file = $temp;}
        
        $mft = explode(":", $this->file);
        
        $template = str_replace(":", "/", $this->file);
        
        $filename = "app/Views/".$template;
        
        $file = FileSystem::findFile($filename);
        
        $output = "Archivo <b>{$this->file}</b> no existe.<br>";
        
        $this->data['_view'] = new ViewHelper();
        $this->data['_shared'] = self::$shared;
        
        if($file)
        {
            $output = FileSystem::capture($file, $this->data);
        }
        return $output;
    }
    
    public function __toString() {
        return (string) $this->render();
    }
}