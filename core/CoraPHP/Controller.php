<?php

namespace CoraPHP;

class Controller{
    
    /** @var Request */
    protected $request = null;
    
    /** @var Response */
    protected $response = null;
    
    /** @var Bucket */
    protected $bucket = null;
    
    public function __construct(Request $request)
    {
        $this->bucket = Bucket::instance();
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
    
    public function get($library)
    {
        return $this->bucket->get($library);
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
        $event = Event::create(array(
            "request" => $this->request
        ));
        
        EventManager::raiseEvent("controller:init", $event);
    }
    
    public function finish(){
        
        $event = Event::create(array(
            "request" => $this->request,
            "response" => $this->response
        ));
        
        EventManager::raiseEvent("controller:finish", $event);
    }
}