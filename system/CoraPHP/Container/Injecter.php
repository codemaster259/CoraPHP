<?php

namespace System\CoraPHP\Container;

class Injecter{
    
    //callback mode
    protected $deps = array();
    
    public function add($name, $callback){
        
        //echo "$name added<br>";
        $this->deps[$name] = $callback;
    }
    
    public function get($name){
        
        //echo "$name called<br>";
        if(isset($this->deps[$name])){
            
            if(is_callable($this->deps[$name]))
            {
                //echo "$name stored<br>";
                $this->deps[$name] = call_user_func_array($this->deps[$name], array($this));
            }
            
            return $this->deps[$name];
        }
        
        return null;
    }
    
    protected $deps2 = array();
    
    public function register($name, $class, $dependences = array(), $passDependences = false)
    {
        $this->deps2[$name] = array(
            "class" => $class,
            "dependences" => $dependences,
            "pass" => $passDependences
        );
    }
    
    //reflection mode
    public function obtain($name)
    {
        try{
            if(isset($this->deps2[$name]))
            {
                $class = $this->deps2[$name]["class"];
                $dependences = $this->deps2[$name]["dependences"];
                $pass = $this->deps2[$name]["pass"];

                if(is_callable($class))
                {
                    $this->deps2[$name]["class"] = call_user_func_array($class, array($this));
                    return $this->deps2[$name]["class"];
                }

                if(!is_string($class))
                {
                    return $class;
                }

                if(!class_exists($class))
                {
                    return $class;
                }

                $args = array();

                if(!$pass)
                {
                    foreach ($dependences as $dependency)
                    {
                        if(isset($this->deps2[$dependency]))
                        {
                            $args[] = $this->obtain($dependency);
                        }else{
                            throw new \Exception("Dependency ($dependency) not found for ($class)");
                        }
                    }
                }else{
                    $args = $dependences;
                    
                }
                $reflex = new \ReflectionClass($class);
                return $this->deps2[$name]["class"] = $reflex->newInstanceArgs($args);
            }
        
            throw new \Exception("Dependency ($name) not found");
        
        }catch(\Exception $e)
        {
            echo $e->getMessage();
            die();
        }
    }
}