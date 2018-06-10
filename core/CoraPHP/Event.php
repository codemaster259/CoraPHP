<?php

namespace CoraPHP;

class Event extends DataBag{
    
    public static function create($data = array())
    {
        $event = new Event();
        
        $event->fill($data);
        
        return $event;
    }
    
    private $name = "";
    
    public function setName($name)
    {
        $this->name = $name;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    protected $stopEvent = false;
    
    public function stopEvent()
    {
        $this->stopEvent = true;
    }
    
    public function continueEvent()
    {
        return !$this->stopEvent;
    }
    
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

