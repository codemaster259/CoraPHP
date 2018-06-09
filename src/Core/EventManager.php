<?php

namespace Core;

class EventManager{
    
    protected static $listeners = array();
    protected static $all = array();
    
    public static function listenTo($name, $callback){
        if(!isset(self::$events[$name]))
        {
            self::$events[$name] = array();
        }
        
        self::$events[$name] = $callback;
    }
    
    public static function listenAll($callback)
    {
        self:$all[] = $callback;
    }
    
    public static function raiseEvent($name, Event $event){
        
        if(isset(self::$events[$name]))
        {
            foreach(self::$events[$name] as $callback)
            {
                call_user_func_array($callback, array(
                    'name' => $name,
                    'event' => $event
                ));
            }
        }
    }
}
