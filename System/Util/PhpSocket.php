<?php

namespace System\CoraPHP\Util;

class PHPSocket{
    
    private $server;
    private $port;
    private $timeout;

    public $errno;
    public $errstr;
    
    private $socket;

    private $response;
    
    function __construct($server, $port, $timeout = 360)
    {
        $this->server = $server;
        $this->port = $port;
        $this->timeout = $timeout;
    }

    function open()
    {
        $this->socket = fsockopen("ssl://".$this->server, $this->port, $this->errno, $this->errstr, $this->timeout);
        
        if(!$this->socket)
        {
            return false;
        }

        return true;
    }
    
    function write($string)
    {
        $this->response = "";

        fwrite($this->socket, $string);

        while(substr($fg = fgets($this->socket, 256), 3, 1) != " ")
        {
            $this->response = $fg;
        }

        return trim($this->response);
    }
    
    function close()
    {
        fwrite($this->socket, "QUIT\r\n");
        return fclose($this->socket);
    }
}