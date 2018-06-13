<?php

namespace CoraPHP;

class Router{
    
    public $url = "/";
    
    private static $routes = array();
    
    public static function registerRoutes($routes = array())
    {
        foreach($routes as $route => $data)
        {
            self::$routes[$route] = $data;
        }
    }
    
    public static function getRouteByName($name)
    {
        return isset(self::$routes[$name]) ? self::$routes[$name]['route'] : $name;
    }
    
    function dispatch($url = "/")
    {
        if($url== "")
        {
            $url= "/";
        }
        
        $this->url = $url;
        
        $match = null;
        
        //match by name
        if(isset(self::$routes[$this->url]))
        {
            $match = self::$routes[$this->url]['path'];
            $this->url = self::$routes[$this->url]['path'];
            
        }else{
            //match by path
            foreach(self::$routes as $route)
            {
                if(isset($route['route']) && $route['route'] == $this->url)
                {
                    $match = $route['path'];
                    break;
                }
            }
        }
        
        //filter url
        if($match)
        {
            $ModuleControllerAction = explode(":", strtolower($match));

            $module = ucwords($ModuleControllerAction[0]);
            $controller = ucwords($ModuleControllerAction[1]);
            $action = $ModuleControllerAction[2];

            $controllerName = $module."\\Controller\\".$controller."Controller";
            
            $request = new Request($this->url);
            
            $request->attributes->set("_controller", $controller)
                    ->set("_module", $module)
                    ->set("_action", $action)
                    ->set("_url", $this->url);

            if(!class_exists($controllerName))
            {
                $controllerName = "CoraPHP\\ErrorController";
            }
            
            /* @var Controler $controllerObject  */
            $controllerObject = new $controllerName($request);
            
            if(!$controllerObject->actionExists($action))
            {
                $action = "index";
            }

            $result = $controllerObject->execute($action);

            return $result;

        }else{
            return new Response("<strong>No match for {$this->url}.</strong><br/>");
        }
    }
    
    public static function make($url, $routes = array())
    {
        self::registerRoutes($routes);
        
        $router = new self();
        return $router->dispatch($url);
    }
}