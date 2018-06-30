<?php

namespace System\CoraPHP;

class INIParser{
	
	public static function load($file)
	{
		$handle = fopen($file, "r") or exit("Unable to open {$file}!");
		
		$lines = array();
		$comments = array(";","#");
		
		//Output a line of the file until the end is reached
		while(!feof($handle))
		{
			$line = fgets($handle);
			if(trim($line) != "")
			{
				$lines[] = $line;
			}
		}
		fclose($handle);
		
		$INI = array();
		
		$currentSection = null;
		
		//patterns
		
		$SEC = "#\[([a-zA-Z_\-.]*)\]#";
		$KV = "#[a-zA-Z0-9]+[\s]?[=][\s]?[a-zA-Z0-9@\\_\-\"\'\/\:\s.]+#";
		
		foreach($lines as $line)
		{
			//comment
			if(!in_array(trim($line)[0], $comments))
			{
				//echo "Comment: $line<hr>";
				$m = array();
				if(preg_match($SEC, trim($line), $m))
				{
					$line = $m[1];
					
					echo "Section: $line <hr>";
					
					$INI[$line] = array();
					
					$currentSection = $line;
				}

				if(preg_match($KV, $line))
				//if(strpos($line, "=") !== false && (strpos($line, "[") == 0 && strpos($line, "]") == 0))
				{
					$ex = explode("=", $line);

					$k = trim($ex[0]);
					$v = trim(trim(trim($ex[1]),"'"),'"');

					if(count($ex) == 2 && $k != "" && trim($ex[1]) != "")
					{
						$INI[$currentSection][$k] = $v;
						echo "Key: $k - Value: $v<hr>";
					}else{
						echo "Invalid: $line<hr>";
					}
				}
			}
		}
		
		return $INI;
	}
	
    protected static function startsWith($needle, $string)
    { 
        return (substr($string, 0, strlen($needle)) === $needle);
    }

    protected static function endsWith($needle, $string)
    {        
        return (substr($string, -strlen($needle)) === $needle);
    }
}
