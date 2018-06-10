<?php

namespace CoraPHP;

class EventManager{
    
    public static $listeners = array();
    public static $all = array();
    
    public static function listenTo($name, $callback){
        
        if(!isset(self::$listeners[$name]))
        {
            self::$listeners[$name] = array();
        }
        
        self::$listeners[$name][] = $callback;
    }
    
    public static function listenAll($callback)
    {
        //self::$all[] = $callback;
        foreach(self::$listeners as $name => $c)
        {
            self::$listeners[$name][] = $callback;
        }
    }
    
    public static function raiseEvent($name, Event $event)
    {    
        $event->setName($name);
        
        if(isset(self::$listeners[$name]))
        {
            foreach(self::$listeners[$name] as $callback)
            {
                if(is_callable($callback))
                {
                    call_user_func_array($callback, array(
                        'name' => $name,
                        'event' => $event
                    ));
                    
                    if($event->stopEvent())
                    {
                        //return true;
                    }
                }
            }
        }else{
            //echo "no listeners for $name";
        }
        /*
        foreach(self::$all as $callback)
        {
            if(is_callable($callback))
            {
                call_user_func_array($callback, array(
                    'name' => $name,
                    'event' => $event
                ));

                if($event->stopEvent())
                {
                    //return true;
                }
            }
        }
        */
    }
}
