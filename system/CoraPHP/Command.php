<?php
namespace System\CoraPHP;

class Command{
	
	protected static $commands = array();
	
	
	//namespace:area:action
	public static function addCommand($name, $command)
	{
		
		extract(self::splitCommand($name));
		
		if(!isset(self::$commands[$ns]))
		{
			self::$commands[$ns] = array();
			//echo "$ns created\n";
		}
		
		if(!isset(self::$commands[$ns][$cls]))
		{
			self::$commands[$ns][$cls] = array();
			//echo "$cls created in $ns\n";
		}
		
		
		self::$commands[$ns][$cls][$act] = $command;
		//echo "added $cmd\n";
	}
	
	protected static function splitCommand($cmd, $search = false)
	{
		$data = array();
		
		$exp = explode(":", $cmd);
		
		if($search)print_r($exp);
		$data['ns'] = (isset($exp[0]) && $exp[0] !== "") ? array_shift($exp) : "system";
		if($search)print_r($exp);
		$data['cls'] = (isset($exp[0]) && $exp[0] !== "") ? array_shift($exp) : "default";
		if($search)print_r($exp);
		$data['act'] = (isset($exp[0]) && $exp[0] !== "") ? array_shift($exp) : "action";
		
		if($search)print_r("\nfor ".$cmd."\n");
		if($search)print_r($data);
		
		return $data;
	}
	
	public static function run($argv = array())
	{		
		$file = array_shift($argv);
		
		$name = isset($argv[0]) ? array_shift($argv) : null;
		
		if($name == "-v")
		{
			print_r(self::$commands);
			return;
		}
		
		extract(self::splitCommand($name, true));

		if(isset(self::$commands[$ns]))
		{
			if(isset(self::$commands[$ns][$cls]))
			{
				if(isset(self::$commands[$ns][$cls][$act]))
				{
					$cmd = self::$commands[$ns][$cls][$act];
					
					return call_user_func_array($cmd, $argv);
				}
			}
		}
	}
}