<?php

namespace Core;

class Controller{
    
    /** @var Request */
    protected $request = null;
    
    /** @var Response */
    protected $response = null;
    
    public function __construct($request = null)
    {
        $this->request = $request;
        $this->response = new Response();
    }
    
    public function fordward($url)
    {
        return Router::sub($url);
    }
    
    public function redirect($urlOrRoute = "/")
    {
        $url = Router::getRouteByName($urlOrRoute);
        
        if(!$url)
        {
            $url = $urlOrRoute;
        }
        
        header("Location: {$url}");
        exit();
    }
    
    public function load($library, $dependences = null)
    {
        $mcm = explode(":", $library);

        $module = ucwords(strtolower($mcm[0]));
        $section = ucwords(strtolower($mcm[1]));
        $class = $mcm[2];
        
        $libString = "{$module}\\{$section}\\{$class}";
        
        $reflex = new \ReflectionClass($libString);
        
        if($dependences)
        {
            $lib = $reflex->newInstanceArgs($dependences);
        }else{
            $lib = $reflex->newInstanceArgs();
        }
        
        return $lib;
    }
 
    public function execute($action)
    {
        $init = $this->init();
        if($init)
        {
            return $init;
        }
        
        $method = $action."Action";
        
        if($this->actionExists($action))
        {
            $this->{$method}();
        }

        $finish = $this->finish();
        if($finish)
        {
            return $finish;
        }
        
        return $this->response;
    }
    
    public function actionExists($action)
    {
        return method_exists($this,$action."Action");
    }
    
    public function init(){}
    
    public function finish(){}
}