<?php

namespace System\CoraPHP\Model;


/**
 * Description of ActiveRecord
 *
 * @author Pirulo
 */
abstract class Entity{
    
    public $id = null;
    
    public abstract function getTable();
    
    public function fill($data = null){
        
        if(!$data)
        {
            return null;
        }
        
        foreach ($data as $prop => $value)
        {
            if(property_exists($this, $prop))
            {
                $this->{$prop} = $value;
            }
        }
        
        return $this;
    }
    
        /**
     * 
     * @param array $data
     * @return static
     */
    public function make($data = array()){
        
        $me = new static();
        
        $me->fill($data);

        return $me;
    }
    
    public function makeAll($items){
        
        $list = array();
        
        foreach ($items as $data)
        {
            $list[] = $this->make($data);
        }
        return $list;
    }
    
        /**
     * Return an array containing only public vars
     * 
     * @return array
     */
    public function getPublicVars(){
        
        return get_object_public_vars($this);
    }
    
    public function getNotNull()
    {
        $r = array();
        foreach($this->getPublicVars() as $prop=>$val)
        {
            if($val != null)
            {
                $r[$prop] = $val;
            }
        }
        
        return $r;
    }
}
