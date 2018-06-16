<?php

namespace CoraPHP\Model;

use CoraPHP\Container\Bucket;

class Database{
    
    /** @var \PDO */
    protected $pdo = null;
    
    protected $host = null;
    protected $user = null;
    protected $pass = null;
    protected $dbname = null;
       
    public function __construct($database)
    {
        $this->user = $database['user'];
        $this->pass = $database['pass'];
        $this->host = $database['host'];
        $this->dbname = $database['dbname'];
    }
    
    protected function connect()
    {
        $this->pdo = new \PDO("mysql:dbname=$this->dbname;host=$this->host", $this->user, $this->pass);
    }
    
    protected function disconnect()
    {
        $this->pdo = null;
    }
    
    public function queryAll($sql, $data = array())
    {
        $this->connect();
        
        $sth = $this->pdo->prepare($sql);
        
        foreach($data as $key => $value)
        {
            $sth->bindValue($key, $value);
        }
        
        $res = array();
        
        if($sth->execute())
        {
            $res = $sth->fetchAll(\PDO::FETCH_ASSOC);
        }
        
        $this->disconnect();
        
        return $res;
    }
    
    public function queryOne($sql, $data = array())
    {
        $this->connect();
        
        $sth = $this->pdo->prepare($sql);
        
        foreach($data as $key => $value)
        {
            $sth->bindValue($key, $value);
        }
        
        $res = null;
        
        if($sth->execute())
        {
            $res = $sth->fetch(\PDO::FETCH_ASSOC);
        }
        
        $this->disconnect();
        
        return $res;
    }
    
    public function execute($sql)
    {
        $this->connect();
        
        $sth = $this->pdo->prepare($sql);
        
        $res = $sth->execute();
        
        $this->disconnect();
        
        return $res;
    }
}