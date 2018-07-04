<?php
namespace System\CoraPHP;

class Command{
	
    protected static $commands = array();

    public static function addCommand($name, $command)
    {
        extract(self::splitCommand($name));

        if(!isset(self::$commands[$ns]))
        {
            self::$commands[$ns] = array();
        }

        if(!isset(self::$commands[$ns][$cls]))
        {
            self::$commands[$ns][$cls] = array();
        }

        self::$commands[$ns][$cls][$act] = $command;
    }

    protected static function splitCommand($cmd, $search = false)
    {
        $data = array();

        $exp = explode(":", $cmd);


        $data['ns'] = (isset($exp[0]) && $exp[0] !== "") ? array_shift($exp) : "system";

        $data['cls'] = (isset($exp[0]) && $exp[0] !== "") ? array_shift($exp) : "default";

        $data['act'] = (isset($exp[0]) && $exp[0] !== "") ? array_shift($exp) : "action";

        return $data;
    }

    public static function run($argv = array())
    {
        $file = array_shift($argv);

        $command = isset($argv[0]) ? array_shift($argv) : null;
        
        if(!$command)
        {
            echo "Need a command";
            return;
        }

        if($command == "-v")
        {
            print_r(self::$commands);
            return;
        }

        self::execute($command, $argv);
    }
    
    public static function execute($command, $args)
    {
        extract(self::splitCommand($command, true));

        if(isset(self::$commands[$ns]))
        {
            if(isset(self::$commands[$ns][$cls]))
            {
                if(isset(self::$commands[$ns][$cls][$act]))
                {
                    $cmd = self::$commands[$ns][$cls][$act];

                    return call_user_func_array($cmd, $args);
                }
            }
        }
    }
}