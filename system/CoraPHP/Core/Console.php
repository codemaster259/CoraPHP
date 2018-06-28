<?php

namespace CoraPHP\Core;

class Console{

    private static $data = array();
    
    static function command($cmd)
    {
        switch($cmd)
        {
            case 'std:dump':
                echo "<pre>".print_r(self::$data, true)."</pre>";
                return true;

            case 'std:add':
                $name = func_get_arg(1);
                $value = func_get_arg(2);
                self::$data[$name] = $value;
                return true;

            case 'std:call':
                $callback = self::$data[func_get_arg(1)];
                $params = (func_num_args() >=3) ? func_get_arg(2) : array();
                return call_user_func_array($callback, $params);

            case "std:get":
                $name = func_get_arg(1);
                return isset(self::$data[$name]) ? self::$data[$name] : null;
                
            case "std:createModule":
                $module = func_get_arg(1);
                $root = (func_get_arg(2)) ? func_get_arg(2) : null;
                return self::createModule($module, $root);
                
        }
    }
    
    public static function createModule($name, $root)
    {
        $name = ucwords(strtolower($name));
        
        if(!file_exists($root.$name))
        {
            //create module folder
            mkdir($root.$name);
            
            //module class
            self::createModuleFile($root.$name."/Module.php", SYSTEM_ROOT."CoraPHP/Bundle/Module.txt", $name);
            
            //ini module
            self::createModuleFile($root.$name."/ini.php", SYSTEM_ROOT."CoraPHP/Bundle/ini.txt", $name);

            //config dir
            mkdir($root.$name."/Config");
            
            //routes
            self::createModuleFile($root.$name."/Config/routes.ini", SYSTEM_ROOT."CoraPHP/Bundle/routes.txt", $name);
            
            //settings
            self::createModuleFile($root.$name."/Config/settings.ini", SYSTEM_ROOT."CoraPHP/Bundle/settings.txt", $name);
            
            //controller dir
            mkdir($root.$name."/Controller");
            
            //controller
            self::createModuleFile($root.$name."/Controller/DefaultController.php", SYSTEM_ROOT."CoraPHP/Bundle/Controller.txt", $name);

            mkdir($root.$name."/Service");
            
            //views dir
            mkdir($root.$name."/Views");
            
            mkdir($root.$name."/Views/Layout");
            //layout
            self::createModuleFile($root.$name."/Views/Layout/base.php", SYSTEM_ROOT."CoraPHP/Bundle/layout.txt", $name);
 
            mkdir($root.$name."/Views/Default");
            //index
            self::createModuleFile($root.$name."/Views/Default/index.php", SYSTEM_ROOT."CoraPHP/Bundle/index.txt", $name);
        }
    }
    
    private static function createModuleFile($path, $temp, $name)
    {
        $file = fopen($path, "w") or die("Unable to open file!");
        $content = str_replace("{{Module}}", $name, file_get_contents($temp));
        $content = str_replace("{{module}}", strtolower($name), $content);
        fwrite($file, $content);
        fclose($file);
    }
}

/*
Console::command("std:add",'fn.sayHello',function(){
    echo "Hello World!";
    }
);
Console::command("std:call",'fn.sayHello');

Console::command("std:add",'str.name', 'lol');

echo ">".Console::command("std:get",'str.name');

Console::command("std:dump");
*/