<?php

namespace CoraPHP\Http;

use CoraPHP\Container\DataBag;
use CoraPHP\Container\FlashBag;
use CoraPHP\Container\SessionBag;

class Request{
    
    /** @var DataBag $_POST */
    public $post = null;
    
    /** @var DataBag $_GET */
    public $get = null;
    
    /** @var DataBag $_FILES */
    public $files = null;
    
    /** @var DataBag $_SESSION[flash key] */
    public $flash = null;
    
    /** @var DataBag $_SESSION[session key] */
    public $session = null;

    /** @var DataBag $_SESSION[session key] */
    public $headers = null;
    
    /** @var DataBag $_SESSION[session key] */
    public $server = null;
    
    /** @var DataBag attributes */
    public $attributes = null;
    
    protected $url = "/";
    
    /** @var Request initial request*/
    protected static $initial = null;
    
    protected $method = 'GET';
    
    public function __construct($url = "/")
    {
        $this->url = $url;
        
        //fill globals
        $this->post = new DataBag($_POST);
        $this->get = new DataBag($_GET);
        $this->files = new DataBag($_FILES);
        
        $this->attributes = new DataBag();
        $this->flash = new FlashBag('FLASH_VARS');
        $this->session = new SessionBag();
        
        $this->headers = new DataBag(getallheaders());
        
        $this->server = new DataBag($_SERVER);
        
        $this->method = $this->server->get("REQUEST_METHOD");
        
        if(!self::$initial)
        {
            self::$initial = $this;
        }
    }
    
    public function getMethod()
    {
        return $this->method;
    }
    
    public function isPost()
    {
        return $this->isMethod("POST");
    }
    
    public function isMethod($method)
    {
        return strtolower($this->method) == strtolower($method);
    }
    
    public function isInitial()
    {
        return self::$initial == $this;
    }

    /**
     * 
     * @return self
     */
    public function getInitial()
    {
        return self::$initial;
    }
}

