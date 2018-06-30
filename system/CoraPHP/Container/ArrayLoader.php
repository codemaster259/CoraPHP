<?php

namespace System\CoraPHP\Container;

class ArrayLoader{
	   
    /**
     * Loads .ini, .json and .xml files as PHP arrays
     * 
     * @param string $file the file path
     * @param string $root the root path for load files
     * with relative path
     * @return array an array of data
     */
    public static function load($file, $root = "")
    {
        $r = array();
        
        switch($file)
        {
            case self::endsWith(".json", $file):
                $r = self::asJSON($root.$file);
            break;

            case self::endsWith(".ini", $file):
                $r = self::asINI($root.$file);
            break;

            case self::endsWith(".xml", $file):
                $r = self::asXML($root.$file);
            break;
            default:
                return $r;
        }
        return self::map($r, $root, $root.$file);
    }
    
    private static function map($r, $root, $f)
    {
        foreach($r as $key => $data)
        {
            if(!empty($r[$key]))
            {
                if(is_array($r[$key]))
                {
                    if(!self::is_assoc($r[$key]))
                    {
                        $new = array();

                        foreach($data as $res)
                        {
                            if(is_string($key))
                            {
                                $file = $res;
                                $new = array_merge_recursive($new, self::load($file, $root));
                            }
                        }
                        $r = $new;
                    }else{
                        $r[$key] = self::map($r[$key], $root, $f);
                    }
                }
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
    
    protected static function is_assoc($a)
    {
        foreach(array_keys($a) as $k)
        {
            if (!is_int($k))
            {
                return true;
            }
        }
        return false;
    }
}