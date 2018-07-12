<?php

namespace System\CoraPHP\Model;

 use System\CoraPHP\Model\Database;

/**
 * Description of EntityManager
 *
 * @author Pirulo
 */
class EntityManager{
    
    /**
     * @var Database
     */
    protected $db;
    
    public function __construct($db){
        
        $this->db = $db;
    }
    
    public function findById(Entity $object)
    {
        return $object->fill($this->db->selectOne($object->getTable(), "*", array("id" => $object->id)));
    }
    
    public function findBy(Entity $object)
    {
        
        $data = $this->db->selectOne($object->getTable(), "*", $object->getNotNull());
        
        if($data)
        {
            return $object->fill($data);
        }
        return null;
    }
    
    public function findAll(Entity $object)
    {
        return $object->makeAll($this->db->selectAll($object->getTable(), "*", $object->getNotNull()));
    }
    
    public function create(Entity $object)
    {
        return $this->db->insert($object->getTable(), $object->getPublicVars());
    }
    
    public function update(Entity $object)
    {
        return $this->db->update($object->getTable(), $object->getPublicVars(), array("id" => $object->id));
    }
    
    public function delete(Entity $object)
    {
        return $this->db->delete($object->getTable(),array("id" => $object->id));
    }


    /**
     * 
     * @return Database
     */
    public function getDB()
    {
        return $this->db;
    }
}

