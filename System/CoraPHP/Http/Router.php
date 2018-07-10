<?php

namespace System\CoraPHP\Http;

use System\CoraPHP\Container\Injecter;

class Router{
    
    private $url = "/";
    private $request = null;
    
    /**
     *
     * @var Injecter
     */
    private static $injecter = null;
    
    private static $routes = array();
    
    public static function getRoutes(){
        return self::$routes;
    }
    
    public static function registerRoutes($routes = array())
    {
        if(is_array($routes))
        {
            foreach($routes as $route => $data)
            {
                self::addRoute($route, $data);
            }
        }
    }
    
    public static function addRoute($route, $data)
    {
        $data['regex'] = self::prepare($data['route']);
        
        if(!isset($data['method'])){
            $data['method'] = "GET";
        }
        
        self::$routes[$route] = $data;
    }
    
    public static function getRouteByName($name)
    {
        return isset(self::$routes[$name]) ? self::$routes[$name]['route'] : $name;
    }
    
    private static function prepare($pattern)
    {
        //echo "<input type='text' style='width:400px;' value='first: {$pattern}'><br>";
        
        if(preg_match('/[^:\/\*_{}()a-zA-Z\d]/', $pattern))
        {
            //Invalid Pattern
            return false;
        }
        
        $chars = array(
            ':num'  =>  '[0-9]+',          //integers
            ':str'  =>  '[a-zA-Z]+',       //leters
            ':alpha'=>  '[a-zA-Z0-9]+',    //alphanumerics
            ':any'  =>  '[a-zA-Z0-9_]+',   //any but slash
            ':all'  =>  '[a-zA-Z0-9_/\.]*',//matches all usable chars :)
            '{'     =>  '(',               //named start OK
            '}'     =>  ')',               //named end OK
        );
        
        $allowedParamChars = '[a-zA-Z0-9\_]+';
        
        // Turn "(/)" into "/?" DEPRECATED
        //$pattern = preg_replace('#\(/\)#', '/?', $pattern);
        
        
        //todo 0: Change '*' into '?' for making any parameter optional xD
        $pattern = preg_replace('#\*#', '?', $pattern);
        //echo "<input type='text' style='width:400px;' value='*->? {$pattern}'><br>";

        
        //todo 1: required format {parameter:type}
        
        //todo 1.1: replace {parameter} with {parameter:any} DONE
        $pattern = preg_replace(
            '/\{(' . $allowedParamChars . ')}/', // Replace "{parameter}"
            '{$1:any}'                        , // with "{parameter:any}"
            $pattern
        );
        //echo "<input type='text' style='width:400px;' value=':any {$pattern}'><br>";
        
        
        //todo 1.2: replace {:type} with {type:type} DONE
        $pattern = preg_replace(
            '/\{:(' . $allowedParamChars . ')}/', // Replace "{:type}"
            '{$1:$1}'                          , // with "{type:type}"
            $pattern
        );
        //echo "<input type='text' style='width:400px;' value=':any {$pattern}'><br>";        
        
        
        //todo 2: replace {parameter:type} with {?<parameter>:type} DONE
        $pattern = preg_replace(
            '/\{(' . $allowedParamChars . ')/', // Replace "{parameter"
            '{?P<$1>'                        , // with "{?P<parameter>"
            $pattern
        );
        //echo "<input type='text' style='width:400px;' value='type {$pattern}'><br>";
        
        
        //todo 3: replace {?P<parameter>:type} with {?P<parameter>[chars]} DONE
        $searches = array_keys($chars);
        $replaces = array_values($chars);
        
        $pattern = str_replace($searches, $replaces, $pattern);
        //echo "<input type='text' style='width:400px;' value='s-r {$pattern}'><br><br>";

        
        //todo 4: Add start and end matching => REGEX!
        $patternAsRegex = "@^" . $pattern . "$@D";

        return $patternAsRegex;
    }
    
    protected static function noInt($a)
    {
        foreach ($a as $k => $v)
        {
            if(is_int($k)) 
            {
                unset($a[$k]);
            }
        }
        return $a;
    }
    
    public function dispatch($url = "/")
    {
        //url base
        if($url== "")
        {
            $url= "/";
        }
        
        if($url != "/")
        {
            $url = rtrim($url, "/");
        }
        
        //guardar url
        $this->url = $url;
        
        $this->request = new Request($this->url);
        
        //ruta encontrada = null
        $match = null;
        
        $matches = array();
        
        //encontrar ruta por nombre
        if(isset(self::$routes[$this->url]))
        {
            $match = self::$routes[$this->url]['path'];
            $this->url = self::$routes[$this->url]['path'];
            
        }else{
            
            //encontrar por 'regex'
            foreach(self::$routes as $route)
            {
                $matches = array();

                //if($this->request->isMethod($route['method']))
                {
                    if(preg_match($route['regex'], $this->url, $matches))
                    {
                        //$matches = self::noInt($matches);
                        array_shift($matches);
                        //debug($matches);
                        $match = $route;
                        break;
                    }
                }
            }
        }
        
        //ruta encontrada
        if($match)
        {
            if(!$this->request->isMethod($match['method']))
            {
                //return $this->errorPage("Pagina <strong>{$this->url}</strong> no encontrada (M)");
            }
            
            //armar controller
            $ModuleControllerAction = explode(":", strtolower($match['path']));
            
            $module = ucwords($ModuleControllerAction[0]);
            $controller = ucwords($ModuleControllerAction[1]);
            $action = strtolower($ModuleControllerAction[2]);
            
            //llenar objeto request con parametros de url
            $this->request->query->fill($matches);
            
            if(self::$injecter)
            {
                $this->request->injecter = self::$injecter;
            }
            
            //guardar attributos del controller
            $this->request->attributes->set("_module", $module)
                    ->set("_controller", $controller)
                    ->set("_action", $action)
                    ->set("_url", $this->url)
                    ->set("_route", $route['path']);

            //nombre controller
            $controllerName = $module."\\Controller\\".$controller."Controller";
            
            //controller no existe
            if(!class_exists($controllerName))
            {
                return $this->errorPage("Pagina <strong>{$this->url}</strong> no encontrada (C)");
            }
            
            /* @var Controler $controllerObject  */
            $controllerObject = new $controllerName($this->request);
            
            //action no existe
            if(!$controllerObject->actionExists($action))
            {
                return $this->errorPage("Pagina <strong>{$this->url}</strong> no encontrada (A)");
            }

            //ejecutar controller
            $result = $controllerObject->execute($action);

            //retornar result
            return $result;

        }else{
            //no hay ruta definida para esta url
            return $this->errorPage("Pagina <strong>{$this->url}</strong> no encontrada (R)");
        }
    }
    
    protected function errorPage($msg)
    {
        return new Response($msg);
    }
    
    public static function make($url, $routes = array(), $injecter = null)
    {
        self::registerRoutes($routes);
        self::$injecter = $injecter;
        
        $router = new self();
        
        return $router->dispatch($url);
    }
}
