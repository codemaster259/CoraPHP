<?php

namespace Core;

class Controller{
    
    /** @var Request */
    protected $request = null;
    
    /** @var Response */
    protected $response = null;
    
    /** @var Bucket */
    protected $bucket = null;
    
    public function __construct(Bucket $bucket)
    {
        $this->bucket = $bucket;
        $this->request = $this->bucket->get("request");
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
    
    public function init(){}
    
    public function finish(){}
}