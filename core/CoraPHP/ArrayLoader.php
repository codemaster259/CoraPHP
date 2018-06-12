<?php

namespace CoraPHP;

class ArrayLoader{
	
	protected static $recursiveKey = null;
	
	/**
	 * <b>key</b> for check in array and load
	 * it's value as file
	 * 
	 * @param string $key
	 */
	public static function setRecursiveKey($key)
	{
		self::$recursiveKey = $key;
	}
    
	/**
	 * Loads .ini, .json and .xml files as PHP arrays
	 * 
	 * If <b>$recursiveKey</b> is given, it will attempt
	 * to load it's value as new file and merge with
	 * data loaded.
	 * 
	 * @param string $file the file path
	 * @param string $root the root path for load files
	 * with relative path
	 * @return array an array of data
	 */
    public static function load($file, $root = "", $recursiveKey = null)
    {
        if($recursiveKey)
        {
            self::$recursiveKey = $recursiveKey;
        }
        $r = array();
        switch($file)
        {
            case self::endsWith(".json", $file):
                $r = self::asJSON($file);
            break;

            case self::endsWith(".ini", $file):
                $r = self::asINI($file);
            break;

            case self::endsWith(".xml", $file):
                $r = self::asXML($file);
            break;
            default:
                return $r;
        }
        
        foreach($r as $route => $data)
        {
            if(empty($data))
            {
                unset($r[$route]);
                continue;
            }
            if(self::$recursiveKey != null && isset($data[self::$recursiveKey]))
            {
                $file = $root.$data[self::$recursiveKey];
				
                //unset($r[$route]);
				
                $r = array_merge($r, self::load($file, $root, $recursiveKey));
            }
        }
        return $r;
    }
	
    protected static function asJSON($file)
    {
        return json_decode(file_get_contents($file), true);
    }

    protected static function asINI($file)
    {
        return parse_ini_file($file, true);
    }

    protected static function asXML($file)
    {
        return json_decode(json_encode(simplexml_load_file($file)), true);
    }

    protected static function endsWith($needle, $string)
    {        
        return (substr($string, -strlen($needle)) === $needle);
    }
}