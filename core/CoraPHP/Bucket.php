<?php

namespace CoraPHP;

/**
 * Bucket: Container for things
 */
class Bucket{
    
    protected $container = null;
        
    /** @var self */
    private static $instances = array();
    
    /**
     * 
     * @return self
     */
    public static function instance($name = "default")
    {
        if(!isset(self::$instances[$name]))
        {
            self::$instances[$name] = new self;
        }
        
        return self::$instances[$name];
    }
    
    private function __construct()
    {
        $this->container = new DataBag();
    }
    
    public function set($key, $object)
    {
        $this->container->set($key, $object);
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
    
    public function fill($data, $replace = false)
    {
        $this->container->fill($data, $replace);
        
        return $this;
    }
    
    public function has($key)
    {
        return $this->container->has($key);
    }
    
    public function get($key, $def = null)
    {
        return $this->container->get($key, $def);
    }
    
    public function all()
    {
        return $this->container->all();
    }
    
    public function remove($key)
    {
        $this->container->remove($key);
        
        return $this;
    }
}
