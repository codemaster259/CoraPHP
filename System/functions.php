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

/*DEBUG HELPER*/
function debug($obj, $label = null)
{
    if($label)
    {
        $label = "$label:<br>";
    }
    
    echo "<pre>".$label.print_r($obj, 1)."</pre>";
}
/*DEBUG HELPER*/


/*BOOLEAN HELPER*/
function decide($b, $t, $f = null)
{
    return $b ? $t : $f;
}

function is($bool){
    return decide($bool, "true", "false");
}
/*BOOLEAN HELPER*/


/*STRING HELPER*/
function startsWith($needle, $string)
{ 
    return (substr($string, 0, strlen($needle)) === $needle);
}

function endsWith($needle, $string)
{        
    return (substr($string, -strlen($needle)) === $needle);
}
/*STRING HELPER*/


/*OBJECT HELPER*/
function get_object_public_vars($object)
{
    return get_object_vars($object);
}
/*OBJECT HELPER*/


/*LOGIN HELPER*/
define("LOGIN_KEY", md5("LOGIN_KEY"));

function login_init()
{
    if(!isset($_SESSION[LOGIN_KEY]))
    {
        $_SESSION[LOGIN_KEY] = array();
    }
}

function login_set($key, $value = false)
{
    $_SESSION[LOGIN_KEY][$key] = $value;
}

function login_has($key)
{
    return isset($_SESSION[LOGIN_KEY][$key]);
}

function login_get($key)
{
    return login_has($key) ? $_SESSION[LOGIN_KEY][$key] : null;
}

function login_delete($key)
{
    unset($_SESSION[LOGIN_KEY][$key]);
}
/*LOGIN HELPER*/


/*FLASH HELPER*/
define("FLASH_KEY", md5("FLASH_KEY"));

function flash_init()
{
    if(!isset($_SESSION[FLASH_KEY]))
    {
        $_SESSION[FLASH_KEY] = array();
    }
}

function flash_set($key, $value = false)
{
    $_SESSION[FLASH_KEY][$key] = $value;
}

function flash_has($key)
{
    return isset($_SESSION[FLASH_KEY][$key]);
}

function flash_get($key)
{
    return flash_has($key) ? $_SESSION[FLASH_KEY][$key] : null;
}

function flash_delete($key)
{
    unset($_SESSION[FLASH_KEY][$key]);
}

function flash_show($key)
{
    $value = flash_get($key);
    flash_delete($key);
    return $value;
}
/*FLASH HELPER*/


/*GOD LOGIN HELPER*/
function isGod($user, $pass)
{
    $Settings = \System\CoraPHP\Container\Registry::channel("Settings");
    
    return ($user == $Settings->get("god_user") && $pass == $Settings->get("god_pass"));
}
/*GOD LOGIN HELPER*/

login_init();
flash_init();
