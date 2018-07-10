<?php

namespace System\CoraPHP\Http;

use System\CoraPHP\Container\DataBag;
use System\CoraPHP\Container\FlashBag;
use System\CoraPHP\Container\SessionBag;
use System\CoraPHP\Container\Injecter;
use System\CoraPHP\Container\Registry;

class Request{
    
    /** @var DataBag $_POST */
    public $post = null;
    
    /** @var DataBag $_GET */
    public $query = null;
    
    /** @var DataBag $_FILES */
    public $files = null;
    
    /** @var FlashBag $_SESSION['FLASH_VARS'] */
    public $flash = null;
    
    /** @var SessionBag $_SESSION['SESSION_VARS'] */
    public $session = null;
    
    /** @var DataBag attributes */
    public $attributes = null;
    
    /** @var Injecter dependences */
    public $injecter = null;
        
    /** @var Request initial request*/
    protected static $initial = null;
    
    protected $url = "/";
    
    protected $method = 'get';
    
    public function __construct($url = "/")
    {
        $this->url = $url;
        
        //fill globals
        $this->post = new DataBag($_POST);
        $this->query = new DataBag($_GET);
        $this->files = new DataBag($_FILES);
        
        $this->attributes = new DataBag();
        $this->flash = new FlashBag(Registry::channel("Config")->get("flash_vars"));
        $this->session = new SessionBag(Registry::channel("Config")->get("session_vars"));
        
        $this->method = strtolower($_SERVER['REQUEST_METHOD']);
        
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
        return $this->isMethod("post");
    }
    
    public function isMethod($method)
    {
        return $this->method == strtolower($method);
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

