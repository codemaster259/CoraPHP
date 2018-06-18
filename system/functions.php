<?php

if(!defined("CORE_ROOT"))
{
    define('CORE_ROOT', str_replace("\\","/", dirname(dirname(__FILE__))).'/');
}

function define_urls($file = null){
    
    if(!$file)
    {
        $file = __FILE__;
    }
    
    $urls = array();
    
    $core_root = str_replace(DIRECTORY_SEPARATOR,"/",(dirname($file)."/"));
    
    $doc_root = $_SERVER['DOCUMENT_ROOT'];
    
    $core_folder = str_replace($doc_root, "", $core_root );
    
    if($core_folder == "/")
    {
        $core_folder = "";
    }

    $scheme = (isset($_SERVER["HTTPS"]) && strtolower($_SERVER["HTTPS"]) == "on") ? "https://" : "http://";
    
    $core_url = $scheme.$_SERVER['SERVER_NAME']."/".$core_folder;
    
    $real_url = $scheme.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
        
    $request_url = parse_url(rtrim("/".str_replace($core_url,"",$real_url),'/'), PHP_URL_PATH);
    
    if($request_url == "")
    {
        $request_url = "/";
    }
    
    //include/require folder
    $urls["CORE_ROOT"] = $core_root;
    //html 'base' tag
    $urls["CORE_URL"] = $core_url;
    //full request url
    $urls["REAL_URL"] = $real_url;
    //custom request uri fragment
    $urls["REQUEST_URL"] = $request_url;
    
    return $urls;
}

function debug($obj, $label = null)
{
    if($label)
    {
        $label = "$label:<br>";
    }
    
    echo "<pre>".$label.print_r($obj, 1)."</pre>";
}

function decide($b, $t, $f = null)
{
    return $b ? $t : $f;
}

function fake_loader($classOrCommand, $param = null, $other = null)
{
    static $simplelog = false;
    static $paths = array();
    static $commands = array();
    
    $func = __FUNCTION__;
    
    if($classOrCommand[0] == ":")
    {
        $command = $classOrCommand;
        
        switch($command)
        {
            case ":echo":
                echo ":echo $param<br>";
            break;
        
            case ":log":
                $simplelog = $param;
                echo decide($param, ":log ENABLED!<br>");
            break;
        
            case ":register":
                spl_autoload_register($func);
                echo decide($simplelog, "$func registered in spl_autoload_register!<br>");
            break;
        
            case ":addPath":
                $paths[$param] = $param;
                echo decide($simplelog, ":addPath {$param} added!<br>");
            break;
        
            case ":command:add":
                $commands[$param] = $other;
            break;
        
            case ":command:call":
                return isset($commands[$param]) ? call_user_func_array(commands[$param], $other) : null;
                
            case ":command:get":
                return isset($commands[$param]) ? $commands[$param] : $other;
                
            default :
                echo ("COMMAND {$command} NOT DEFINED");
                return true;
        }
    }else{
    
        echo decide($simplelog, "$func: {$classOrCommand}<br>");
        
        foreach($paths as $path)
        {
            $filename = str_replace("\\", "/", $path.$classOrCommand.".php");
            
            if(file_exists($filename))
            {
                echo decide($simplelog, "Existe $filename<br>");
                
                require_once $filename;
                return true;
            }
        }
        
        echo decide($simplelog, "No Existe $filename<br>");
        return false;
    }
}
