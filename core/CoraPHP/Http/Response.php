<?php

namespace CoraPHP\Http;

class Response{
    
    private $body = "";
    
    public function __construct($body = "") {
        $this->body = $body;
    }
    
    public function body($body = null)
    {
        if($body)
        {
            $this->body = $body;
            return $this;
        }
        return $this->body;
    }
    
    public function send()
    {
        return (string) $this->body;
    }
    
    public function __toString()
    {
        return (string) $this->send();
    }
}