<?php

namespace CoraPHP;

class Role{
    
    private $name;
    private $bit = 0;
    
    public function __construct($name)
    {
        $this->name = $name;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function addPerm(Permision $perm)
    {
        $this->bit += $perm->getBit();
        return $this;
    }
    
    public function getPermision()
    {
        return $this->bit;
    }
    
    public function isAllowedTo(Permision $perm)
    {
        return ($this->getPermision() & $perm->getBit());
    }
    
    /**
     * 
     * @param type $name
     * @return self
     */
    public static function create($name)
    {
        return new self($name);
    }
}

class Permision{
    
    private static $list = array();
    
    private static $base_bit = 1;
    private $name;
    private $bit;
    
    private function __construct($name)
    {
        $this->name = $name;
        $this->bit = self::$base_bit;
        
        self::$base_bit *= 2;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function getBit()
    {
        return $this->bit;
    }
    
    public static function All()
    {
        $god = new self("GOD");
        $god->bit = self::xyz(32);
        return $god;
    }
    
    private static function xyz($p)
    {
        $c = 0;
        
        for($i = 0; $i < $p; $i++)
        {
            $c += pow(2, $i);
        }
        return $c;
    }
    
    public static function create($name)
    {
        if(!isset(self::$list[$name]))
        {
            self::$list[$name] = new self($name);
        }
        return self::$list[$name];
    }
}

class User{
    
    private $role = null;
    
    function setRole(Role $role)
    {
        $this->role = $role;
        return $this;
    }
    
    function getRole()
    {
        return $this->role;
    }
}


/*DEVELOP*/

/*PERMISIONS*/
$viewHome = Permision::create("viewHome");

$viewUser = Permision::create("viewUser");
$createUser = Permision::create("createUser");
$editUser = Permision::create("editUser");
$deleteUser = Permision::create("deleteUser");

$fly = Permision::create("fly");


/*ROLES*/
$guest = Role::create("guest")
        ->addPerm($viewHome);

$user = Role::create("user")
        ->addPerm($viewUser);

$admin = Role::create("admin")
        ->addPerm($viewUser)
        ->addPerm($editUser)
        ->addPerm(Permision::create("deleteUser"));

$root = Role::create("superuser")
        ->addPerm(Permision::ALL());

/*TEST*/
$role = $root;
$perm = $deleteUser;

$ok = $role->isAllowedTo($perm);
$yn = $ok ? "" : "not ";

echo "<b>{$role->getName()}</b> <i>is <b>{$yn}</b>allowed to</i> <b>{$perm->getName()}</b><br>";