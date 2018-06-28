<?php

namespace CoraPHP\Model;

class Query{
    
    const SELECT = "SELECT";
    const UPDATE = "UPDATE";
    const DELETE = "DELETE";
    const INSERT = "INSERT";
    
    public static function start()
    {
        return new self();
    }
    
    private $mode = null;
    
    private $query = "";
    
    public function select($table, $columns = "*")
    {
        $this->mode = self::SELECT;
        
        $this->query = "SELECT {$columns} FROM {$table}";
        
        return $this;
    }
    
    public function update($table, array $data)
    {
        $this->mode = self::UPDATE;
        
        $keyValue = "";
        
        $comma = "";
        
        foreach($data as $key => $value)
        {
            $keyValue .= "{$comma}{$key} = '{$value}'";
            $comma = ", ";
        }
        
        $this->query = "UPDATE {$table} SET ({$keyValue})";
        
        return $this;
    }
    
    public function insert($table, array $data)
    {
        $this->mode = self::INSERT;
        
        $keys = implode("', '",array_keys($data));
        $values = implode("', '",array_values($data));
        
        $this->query = "INSERT INTO {$table} ('{$keys}') VALUES ('{$values}')";
        
        return $this;
    }
    
    public function delete($table, $where)
    {
        $this->mode = self::SELECT;
        
        $this->query = "DELETE FROM {$table} WHERE {$where}";
        
        return $this;
    }
    
    public function where($where)
    {
        $this->query .= " WHERE ".$where;
        
        return $this;
    }
    
    public function getSql()
    {
        return $this->query.";";
    }
}
