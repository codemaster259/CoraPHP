<?php

namespace System\CoraPHP\Services;

use System\CoraPHP\Util\PHPSocket;

class MailOut{
    
    private $server;
    private $port;
    private $user;
    private $pass;
    
    private $headers;
    
    private $from;
    private $to = array();

    private $subject = "";
    private $content = "";
    
    private $error;
    /**
     *
     * @var type PhpSocket;
     */
    private $socket;
    
    private $newline = "\r\n";
    
    private $response = array();
    
    public function __construct($server, $port, $user, $pass){
        
        $this->server = $server;
        $this->port = $port;
        $this->user = $user;
        $this->pass = $pass;

        $this->headers = array();
    }
    
    public function setHeader($name, $value){
        $this->headers[$name] = $value;
        
        return $this;
    }

    public function from($from)
    {
        $this->from = $from;
    }   

    public function to($to)
    {
        $this->to[] = $to;
        
        return $this;
    }

    public function setSubject($subject = "")
    {
        $this->subject = $subject;
        
        return $this;
    }
    
    public function setContent($content = ""){

        $this->content = $content;
        
        return $this;
    }
    
    public function send()
    {
        $this->socket = new PHPSocket($this->server, $this->port);

        echo "Connecting: {$this->server}:{$this->port}{$this->newline}";
        
        if(!$this->socket->open())
        {
            $this->error = "ERROR: Code:{$this->socket->errstr} ({$this->socket->errno}){$this->newline}";
            return false;
        }
        
        $this->response["status"] = $this->socket->errno;
        
        //EHLO
        $this->socket->write("EHLO {$this->server}".$this->newline);

        //REQUEST LOGIN
        $this->socket->write("AUTH LOGIN".$this->newline);

        //USER
        $this->socket->write(base64_encode($this->user).$this->newline);

        //PASS
        $this->socket->write(base64_encode($this->pass).$this->newline);

        //FROM
        $this->socket->write("MAIL FROM: <{$this->from}>".$this->newline);

        //TO's
        foreach($this->to as $to)
        {
            $this->socket->write("RCPT TO: <{$to}>".$this->newline);
        }

        //DATA
        $this->socket->write("DATA".$this->newline);

        //CONTENT

        $template = "Subject: ".($this->subject)."\r\n"
        ."To: <".implode('>, <',$this->to).">\r\n"
        ."From: ".$this->from."\r\n"
        ."MIME-Version: 1.0\r\n"
        ."Content-Type: text/html; charset=utf-8\r\n"
        ."Content-Transfer-Encoding: base64\r\n\r\n"
        ."".base64_encode($this->content)."\r\n.";

        $this->socket->write($template.$this->newline);
        
        return $this->socket->close();
    }
    
    public function getError(){
        return $this->error;
    }
}