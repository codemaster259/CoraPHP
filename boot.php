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

define('CORE_ROOT', dirname(__FILE__).'/');

require_once CORE_ROOT."app/functions.php";
require_once CORE_ROOT."core/CoraPHP/Loader.php";

use CoraPHP\Loader;
use CoraPHP\Router;
use CoraPHP\View;
use CoraPHP\Bucket;
use CoraPHP\ArrayLoader;
use CoraPHP\INIParser;

//Init Loader
Loader::load();
//Loader::enableLog();
Loader::addPath(CORE_ROOT."src/");
Loader::addPath(CORE_ROOT."core/");


Bucket::instance()->set("URLS", define_urls(__FILE__));


$url = Bucket::instance()->get("URLS")["REQUEST_URL"];

//Default Views Path
View::$DEFAULT_PATH = CORE_ROOT."src/";

ArrayLoader::setRecursiveKey("resource");

$routes = ArrayLoader::load(CORE_ROOT."app/config/routes.ini", CORE_ROOT);

debug($routes);

Router::registerRoutes($routes);

$router = new Router();

$response = $router->dispatch($url);

echo $response;

/*
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

EventManager::raiseEvent($url, Event::create(array("url" => $url)));
*/