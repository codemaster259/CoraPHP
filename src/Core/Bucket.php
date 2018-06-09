<?php

namespace Core;

/**
 * Bucket: Container for things
 */
class Bucket{
    
    protected $container = null;
    protected $name = null;
    
    public function __construct($name) {
        $this->name = $name;
        $this->container = array();
    }
    
    public function set($key, $object)
    {
        $this->container[$key] = $object;
        return $this;
    }
    
    public function load($library, $dependences = null)
    {
        if(!$this->has($library))
        {
            $pcs = explode(":", $library);

            $module = ucwords(strtolower($pcs[0]));
            $section = ucwords(strtolower($pcs[1]));
            $class = $pcs[2];

            $libString = "{$module}\\{$section}\\{$class}";

            $reflex = new \ReflectionClass($libString);

            if($dependences)
            {
                $lib = $reflex->newInstanceArgs($dependences);
            }else{
                $lib = $reflex->newInstanceArgs();
            }

            $this->set($library, $lib);
        }
        
        return $this->get($library);
    }
    
    public function has($key)
    {
        return isset($this->container[$key]);
    }
    
    public function get($key)
    {
        return $this->has($key) ? $this->container[$key] : null;
    }
    
    public function remove($key)
    {
        if($this->has($key))
        {
            unlink($this->container[$key]);
        }
        
        return $this;
    }
}
