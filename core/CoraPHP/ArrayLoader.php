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
        
        return self::map($r, $root);
    }
    
    private static function map($r, $root)
    {
        foreach($r as $key => $data)
        {
            echo "$key ";
            if(empty($data))
            {
                unset($r[$key]);
                continue;
            }
            
            if(is_array($r[$key]))
            {
                echo " is array";
                
                if($key == self::$recursiveKey)
                {
                    echo " is recursive<br>";

                    $new = array();
                    
                    foreach($r[$key] as $res)
                    {
                        $file = $root.$res;

                        echo "import: $res<br>";
                        $new = array_merge($new, self::load($file, $root, self::$recursiveKey));
                    }

                    $r = $new;

                }else{
                    echo " not recursive, procesar<br>";
                    $r[$key] = self::map($r[$key], $root);
                }
            }
        }
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