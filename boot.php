<?php

error_reporting(E_ALL);

session_start();

define('CORE_ROOT', str_replace("\\","/", dirname(__FILE__)).'/');

require_once CORE_ROOT."app/functions.php";
require_once CORE_ROOT."core/CoraPHP/Core\Loader.php";

use CoraPHP\Core\Loader;
use CoraPHP\Core\Logger;
use CoraPHP\Core\Console;
use CoraPHP\Core\Module;

use CoraPHP\Http\Router;

use CoraPHP\Container\Bucket;
use CoraPHP\Container\ArrayLoader;

use CoraPHP\Model\Database;

//Init Loader
Loader::load();
//Loader::enableLog();
Loader::addPath(CORE_ROOT."src/");
Loader::addPath(CORE_ROOT."core/");

Logger::enabled(true);

//FILL BUCKET
Bucket::instance()->set("Urls", define_urls(__FILE__));
Bucket::instance()->set("database", Database::instance());
Bucket::instance()->fill(ArrayLoader::load(CORE_ROOT."app/config/config.ini"));

Module::loadModules(CORE_ROOT."src/");

//ROUTING
$routes = Bucket::instance()->get("Routes");

$url = Bucket::instance()->get("Urls")["REQUEST_URL"];

$response = Router::make($url, $routes);

echo $response;

if(isset($_GET['cmd']))
{
    Console::command($_GET['cmd']);
}

/*
//Another Wierd Router xD
use CoraPHP\System;
$s = new System("Test");

//make route list

//add route
$s->add("routes", function($s, $name = null, $route = null){
    
    static $r = array();
    
    echo $s == null ? "yes" : "no";
    
    if($name && $route)
    {
        $r[$name] = $route;
    }else{
        return $r;
    }
});

$s->add("route", function($s, $url = "/"){
    
    $routes = $s->routes($s);
    
    if(isset($routes[$url]))
    {
        if(is_callable($routes[$url]))
        {
            return call_user_func_array($routes[$url], array($url));
        }
        
        return $routes[$url];
    }
});

$s->routes("/", function($s){
    echo "HOME!";
});

$s->routes("/about", function($s){
    echo "MORE!";
});

echo $s->route($url);
*/



/*
//Routing with EventManager xD

use CoraPHP\Events\Event;

Event::listenTo("/", function($event, $data){
    Event::trigger("_base", array("content" => "Home Page!"));
});

Event::listenTo("/about", function($event, $data){
    Event::trigger("_base", array("content" => "Admin Page!"));
});

Event::listenTo("_menu", function($event, $data){
    echo "menu - menu - menu";
});

Event::listenTo("_base", function($event, $data){
    echo "Header<br>";
    Event::trigger("_menu");
    echo "<br>";
    echo $data['content']."<br>";
    echo "Footer<br>";
});

//and $data can be user as "Service Locatior / Container" :D

$data = array();

$data['url'] = $url;

Event::trigger($url, $data);

*/