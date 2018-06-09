<?php

function command($cmd)
{
    static $data = array();
    
    switch($cmd)
    {
        case 'std:dump':
            echo "<pre>".print_r($data, true)."</pre>";
        break;
        
        case 'command:add':
            $name = func_get_arg(1);
            $value = func_get_arg(2);
            $data[$name] = $value;
        break;
    
        case 'command:exe':
            $callback = $data[func_get_arg(1)];
            $params = (func_num_args() >=3) ? func_get_arg(2) : array();
            return call_user_func_array($callback, $params);
    
        case "command:get":
            $name = func_get_arg(1);
            return isset($data[$name]) ? $data[$name] : null;

    }
}

command("command:add",'fn.sayHello',function(){
    echo "Hello World!";
    }
);
command("command:exe",'fn.sayHello');

command("command:add",'str.name', 'lol');

echo ">".command("command:get",'str.name');

command("std:dump");
