<?php

if(!defined("CORE_ROOT"))
{
    define('CORE_ROOT', str_replace("\\","/", dirname(dirname(__FILE__))).'/');
}

function define_urls(){
    
    $urls = array();

    $scheme = (isset($_SERVER["HTTPS"]) && strtolower($_SERVER["HTTPS"]) == "on") ? "https://" : "http://";
        
    $port = "";
    
    if($_SERVER['SERVER_PORT'] != 80)
    {
        $port = ":".$_SERVER['SERVER_PORT'];
    }
    
    $real_url = $scheme.$_SERVER['SERVER_NAME'].$port.$_SERVER["REQUEST_URI"];
        
    $request_url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

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

function is($bool){
    return decide($bool,"true","false");
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
                return isset($commands[$param]) ? call_user_func_array($commands[$param], $other) : null;
                
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

function get_object_public_vars($object)
{
    return get_object_vars($object);
}

function flash_set($key, $value = false)
{
    $flash = new System\CoraPHP\Container\FlashBag(\System\CoraPHP\Container\Registry::channel("Settings")->get("flash_vars"));
    $flash->set($key, $value);
}

function flash_has($key)
{
    $flash = new System\CoraPHP\Container\FlashBag(\System\CoraPHP\Container\Registry::channel("Settings")->get("flash_vars"));
    return $flash->has($key);
}

function flash_show($key)
{
    $flash = new System\CoraPHP\Container\FlashBag(\System\CoraPHP\Container\Registry::channel("Settings")->get("flash_vars"));
    return $flash->show($key);    
}

/*SESSIONS*/
function session_set($key, $value = false)
{
    $session = new System\CoraPHP\Container\SessionBag(\System\CoraPHP\Container\Registry::channel("Settings")->get("session_vars"));
    $session->set($key, $value);
}

function session_has($key)
{
    $session = new System\CoraPHP\Container\SessionBag(\System\CoraPHP\Container\Registry::channel("Settings")->get("session_vars"));
    return $session->has($key);
}

function session_get($key = null)
{
    $session = new System\CoraPHP\Container\SessionBag(\System\CoraPHP\Container\Registry::channel("Settings")->get("session_vars"));
    if($key)
    {
        return $session->get($key);
    }
    return $session->all();
}

function session_remove($key = null)
{
    $session = new System\CoraPHP\Container\SessionBag(\System\CoraPHP\Container\Registry::channel("Settings")->get("session_vars"));
    if($key)
    {
        $session->remove($key);
    }
    $session->clear();
}

function isGod($user, $pass)
{
    $Settings = \System\CoraPHP\Container\Registry::channel("Settings");
    
    return ($user == $Settings->get("god_user") && $pass == $Settings->get("god_pass"));
}