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
            break;

            case 'std:add':
                $name = func_get_arg(1);
                $value = func_get_arg(2);
                self::$data[$name] = $value;
            break;

            case 'std:exe':
                $callback = self::$data[func_get_arg(1)];
                $params = (func_num_args() >=3) ? func_get_arg(2) : array();
                return call_user_func_array($callback, $params);

            case "std:get":
                $name = func_get_arg(1);
                return isset(self::$data[$name]) ? self::$data[$name] : null;

        }
    }
}

/*
Console::command("std:add",'fn.sayHello',function(){
    echo "Hello World!";
    }
);
Console::command("std:exe",'fn.sayHello');

Console::command("std:add",'str.name', 'lol');

echo ">".Console::command("std:get",'str.name');

Console::command("std:dump");
*/