<?php

namespace CoraPHP\Http;

class Router{
    
    private $url = "/";
    
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
        //url base
        if($url== "")
        {
            $url= "/";
        }
        
        //guardar url
        $this->url = $url;
        
        //ruta encontrada = null
        $match = null;
        
        //encontrar ruta por nombre
        if(isset(self::$routes[$this->url]))
        {
            $match = self::$routes[$this->url]['path'];
            $this->url = self::$routes[$this->url]['path'];
            
        }else{
            //encontrar por 'path'
            foreach(self::$routes as $route)
            {
                if(isset($route['route']) && $route['route'] == $this->url)
                {
                    $match = $route['path'];
                    break;
                }
            }
        }
        
        //ruta encontrada
        if($match)
        {
            //ensamblar controllador
            $ModuleControllerAction = explode(":", strtolower($match));

            $module = ucwords($ModuleControllerAction[0]);
            $controller = ucwords($ModuleControllerAction[1]);
            $action = strtolower($ModuleControllerAction[2]);
            
            //crear objeto requets
            $request = new Request($this->url);
            
            //guardar attributos del controller
            $request->attributes->set("_controller", $controller)
                    ->set("_module", $module)
                    ->set("_action", $action)
                    ->set("_url", $this->url);

            //nombre controller
            $controllerName = $module."\\Controller\\".$controller."Controller";
            
            //controller no existe
            if(!class_exists($controllerName))
            {
                return $this->errorPage("Pagina {$this->url} no encontrada (C)");
            }
            
            /* @var Controler $controllerObject  */
            $controllerObject = new $controllerName($request);
            
            //accion no existe
            if(!$controllerObject->actionExists($action))
            {
                return $this->errorPage("Pagina {$this->url} no encontrada (A)");
            }

            //ejecutar controller
            $result = $controllerObject->execute($action);

            //retornar result
            return $result;

        }else{
            //no hay ruta definida para esta url
            return $this->errorPage("Pagina <strong>$this->url}</strong> no encontrada (R)");
        }
    }
    
    protected function errorPage($msg)
    {
        return new Response($msg);
    }
    
    public static function make($url, $routes = array())
    {
        self::registerRoutes($routes);
        
        $router = new self();
        return $router->dispatch($url);
    }
}
