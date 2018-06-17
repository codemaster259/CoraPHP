<?php

error_reporting(E_ALL);
session_start();

define('CORE_ROOT', str_replace("\\","/", dirname(__FILE__)).'/');

//Requires
require_once CORE_ROOT."core/functions.php";
require_once CORE_ROOT."core/CoraPHP/Core/Loader.php";

//Uses
use CoraPHP\Core\Loader;
use CoraPHP\Core\Logger;
use CoraPHP\Http\Router;
use CoraPHP\Container\Registry;


//Init Loader
Loader::load();
//Loader::enableLog();
Loader::addPath(CORE_ROOT."src/");
Loader::addPath(CORE_ROOT."core/");

//logegr
Logger::enabled(false);

//Registry
Registry::channel("Urls")->fill(define_urls(__FILE__));

//Init MOdules
require_once CORE_ROOT.'src/ini.php';

//ROUTING
echo Router::make(Registry::channel("Urls")->get("REQUEST_URL"), Registry::channel("Routes")->all());


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