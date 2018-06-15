<?php

namespace CoraPHP\Events;

class Event{

    protected static $all = array();
    protected static $listeners = array();
    
    public static function listenTo($event, $callback) {
        if(!is_callable($callback))
        {
            throw new Exception('Invalid callback');
        }
        if(!isset(self::$listeners[strtolower($event)]))
        {
            self::$listeners[strtolower($event)] = array();
        }
        self::$listeners[strtolower($event)][] = $callback;
    }
    
    public static function listenAll($callback)
    {
        if(!is_callable($callback))
        {
            throw new Exception('Invalid callback');
        }
        
        self::$all[] = $callback;
    }
    
    public static function trigger($event, $data = null)
    {
        if(isset(self::$listeners[strtolower($event)]))
        {
            $args = array(
                'event' => strtolower($event),
                'data' => $data
                );
            
            foreach(self::$listeners[strtolower($event)] as $callback)
            {
                call_user_func_array($callback, $args);    
            }
            
            foreach(self::$all as $all)
            {
                call_user_func_array($all, $args);
            }
        }
    }
}

