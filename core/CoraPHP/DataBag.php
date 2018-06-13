<?php

namespace CoraPHP;

class DataBag{
    
    protected $data = array();
    
    public function __construct($data = array())
    {
        $this->data = $data;
    }
    
    /**
     * 
     * @param string $key
     * @param mixed $value
     * @return self
     */
    public function set($key, $value)
    {
        $this->data[$key] = $value;
        
        return $this;
    }
    
    /**
     * 
     * @param array $data
     * @param bool $replace
     * @return self
     */
    public function fill($data = array(), $replace = false)
    {
        if($replace)
        {
            $this->data = $data;
            return $this;
        }
        foreach($data as $key => $value)
        {
            $this->set($key, $value);
        }
        return $this;
    }
    
    /**
     * 
     * @param string $key
     * @param mixed $def
     * @return mixed
     */
    public function get($key, $def = null)
    {
        return isset($this->data[$key]) ? $this->data[$key] : $def;
    }
    
    /**
     * 
     * @param string $key
     * @return boolean
     */
    public function has($key)
    {
        return isset($this->data[$key]);
    }

    /**
     * 
     * @param string $key
     */
    public function remove($key)
    {
        if($this->has($key))
        {
            unlink($this->data[$key]);
        }
        return $this;
    }
    
        
    /**
     * Verifica si esta Vacio
     * @return boolean
     */
    public function isEmpty()
    {
        return empty($this->data);
    }
    
    
    /**
     * retorna toda la data
     * @return array
     */
    public function all()
    {
        return $this->data;
    }
    
    /**
     * Vacia la data
     * @return self
     */
    public function clear()
    {
        $this->data = array();
        
        return $this;
    }
}