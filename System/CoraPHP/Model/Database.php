<?php

namespace System\CoraPHP\Model;

use PDO;

class Database{
    
    /** @var \PDO */
    protected $pdo = null;
    
    protected $host = null;
    protected $user = null;
    protected $pass = null;
    protected $dbname = null;

    public function __construct($host, $user, $pass, $dbname)
    {   
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->dbname = $dbname;
    }
    
    private function connect()
    {
        $this->pdo = new PDO("mysql:dbname=$this->dbname;host=$this->host", $this->user, $this->pass);
    }
    
    private function disconnect()
    {
        $this->pdo = null;
    }
    
    private $error = null;
    
    public function error()
    {
        return $this->error;
    }
    
    /**
     * @param string $sql
     * @param array $data
     * @return array
     */
    protected function queryAll($sql, $data = array())
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
            $res = $sth->fetchAll(PDO::FETCH_ASSOC);
        }
        
        $this->disconnect();
        
        return $res;
    }
    
    protected function queryOne($sql, $data = array())
    {
        debug($this->pdo);
        $this->connect();
        
        $sth = $this->pdo->prepare($sql);
        
        foreach($data as $key => $value)
        {
            $sth->bindValue($key, $value);
        }
        
        $res = null;
        
        if($sth->execute())
        {
            $res = $sth->fetch(PDO::FETCH_ASSOC);
        }
        
        $this->disconnect();
        
        return $res;
    }
        
    protected function execute($sql, $data = array())
    {
        $this->connect();
        
        echo "{$sql}<br>";
        
        $sth = $this->pdo->prepare($sql);
        
        foreach($data as $key => $value)
        {
            $sth->bindValue(":".$key, $value);
        }
        
        $res = $sth->execute();
        
        if(!$res)
        {
            $this->error = $this->pdo->errorInfo()[2];
        }
        
        $this->disconnect();

        return $res;
    }
    
    public function selectOne($table, $fields = "*", $where = "1=1"){
        
        $sql = "SELECT {$fields} FROM {$table} WHERE {$where}";

        
        return $this->queryOne($sql, array());
    }
    
    public function selectAll($table, $fields = "*", $where = "1=1"){
        
        $sql = "SELECT {$fields} FROM {$table} WHERE {$where}";
        
        return $this->queryAll($sql, array());
    }
    
    public function delete($table, $where)
    {
        return $this->execute("DELETE FROM {$table} WHERE {$where}");
    }
    
    
    /*Specific Things*/
    public function update($table, $fields, $where)
    {
        $set = $this->buildUpdate($fields);
        
        if($this->execute("UPDATE {$table} SET {$set} WHERE {$where}", $fields))
        {
            return true;
        }else{
            return $this->error;
        }
    }
    
            
    public function insert($table, $fields){
     
        $values = $this->buildInsert($fields);
        
        if($this->execute("INSERT INTO {$table} {$values}", $fields))
        {
            return $this->pdo->lastInsertId();
        }else{
            return $this->error;
        }
    }
    
    protected $query = "";
    /*helpers*/
    private function buildUpdate(array $fields){
        $f = "";
        $comma = "";
        
        foreach(array_keys($fields) as $field){
            
            $f .= "{$comma}{$field} = ':{$field}'";
            
            $comma = ", ";
        }
        
        return $f;
    }

    private function buildInsert(array $fields){
        
        $f = "(";
        
        //fields
        foreach(array_keys($fields) as $field){
            $comma = "";
            
            $f .= "{$comma}'{$field}'";
            
            $comma = ", ";
        }
        
        $f .= ") VALUES (";
        
        //values
        foreach(array_keys($fields) as $field){
            $comma = "";
            
            $f .= "{$comma}':{$field}'";
            
            $comma = ", ";
        }
        
        $f .= ")";
        
        return $f;
    }
}