<?php

namespace CoraPHP;

class System{
    
    protected $name = null;
    
    protected $forbiden = array();
    
    public function __construct($name)
    {
        $this->name = $name;
        
        $this->forbiden = array("add","call");
    }
    
    protected $callbacks = array();
    
    public function add($name, $callback)
    {
        if(!in_array($name, $this->forbiden))
        {
            $this->callbacks[$name] = $callback;
        }
    }
    
    public function __get($name)
    {
        if(isset($this->callbacks[$name]))
        {
            return $this->callbacks[$name];
        }
    }
    
    public function __call($name, $params)
    {
        if(isset($this->callbacks[$name]))
        {
            $callback = $this->callbacks[$name];
            
            if(is_callable($callback))
            {
                array_unshift($params, $this);
                return call_user_func_array($callback, $params);
            }
        }
        
        return null;
    }
    
    public function call($name)
    {
        if(!in_array($name, $this->forbiden))
        {
            if(isset($this->callbacks[$name]))
            {
                $callback = $this->callbacks[$name];

                if(is_callable($callback))
                {
                    $params = func_get_args();
                    if(!empty($params))
                    {
                        array_shift($params);
                    }
                    array_unshift($params, $this);

                    return call_user_func_array($callback, $params);
                }
            }
        }
        
        return null;
    }
}
