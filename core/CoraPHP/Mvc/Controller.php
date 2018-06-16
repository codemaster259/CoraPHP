<?php

namespace CoraPHP\Mvc;

use CoraPHP\Http\Router;
use CoraPHP\Http\Request;
use CoraPHP\Http\Response;

use CoraPHP\Container\Bucket;

use CoraPHP\Events\Event;

class Controller{
    
    /** @var Request */
    protected $request = null;
    
    /** @var Response */
    protected $response = null;
    
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->response = new Response();
    }
    
    public function fordward($url)
    {
        return Router::make($url);
    }
    
    public function redirect($urlOrRoute = "/")
    {
        header("Location:{$urlOrRoute}".Router::getRouteByName($urlOrRoute));
        exit();
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
    
    public function init(){
        
        $event = array(
            "request" => $this->request,
            "response" => $this->response,
            "cnotroller" => $this
        );
        
        Event::trigger("controller:init", $event);
    }
    
    public function finish(){
        
        $event = array(
            "request" => $this->request,
            "response" => $this->response,
            "cnotroller" => $this
        );
        
        Event::trigger("controller:finish", $event);
    }
}