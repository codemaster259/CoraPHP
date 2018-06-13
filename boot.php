<?php

/* Emulando Symfony:
 * 
 * Rutas:
 * 
 * string = Default:Default:index
 * 
 * Archivo:
 * ../src/Default/controller/DefaultController:indexAction
 * 
 * Vista:
 * 
 * string = Default:Layout:main
 * 
 * DEFAULT_PATH.Default/Views/Layout/main.php
 */


session_start();

define('CORE_ROOT', str_replace("\\","/", dirname(__FILE__)).'/');

require_once CORE_ROOT."app/functions.php";
require_once CORE_ROOT."core/CoraPHP/Loader.php";

use CoraPHP\Loader;
use CoraPHP\Router;
use CoraPHP\Bucket;
use CoraPHP\ArrayLoader;

//Init Loader
Loader::load();
//Loader::enableLog();
Loader::addPath(CORE_ROOT."src/");
Loader::addPath(CORE_ROOT."core/");

//FILL BUCKET
Bucket::instance()->set("Urls", define_urls(__FILE__));

Bucket::instance()->fill(ArrayLoader::load(CORE_ROOT."app/config/config.ini"));


//ROUTING
$routes = Bucket::instance()->get("Routes");
$url = Bucket::instance()->get("Urls")["REQUEST_URL"];

$response = Router::make($url, $routes);

echo $response;



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
 
use CoraPHP\EventManager;
use CoraPHP\Event;

EventManager::listenTo("/", function($name, Event $event){
    echo "Home!";
});

EventManager::listenTo("/admin", function($name, Event $event){
    echo "Admin Page!";
});

EventManager::listenAll(function($name, Event $event){
    echo "<br>Some Footer!";
});

and Event object can be user as "Service Locatior / Container" :D

$data=array();

$data['url'] = $url;

$event = Event::create($data);

EventManager::raiseEvent($url, $event);
*/