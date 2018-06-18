<?php

error_reporting(E_ALL);
session_start();

define('CORE_ROOT', str_replace("\\","/", dirname(__FILE__)).'/');

//Requires
require_once CORE_ROOT."core/functions.php";

fake_loader(":log", false);
fake_loader(":register");
fake_loader(":addPath", CORE_ROOT."src/");
fake_loader(":addPath", CORE_ROOT."core/");

//Uses
use CoraPHP\Core\Logger;
use CoraPHP\Core\FileSystem;
use CoraPHP\Container\Registry;
use CoraPHP\Http\Router;

//Logger
Logger::enabled(false);

//FileSystem
FileSystem::addPath(CORE_ROOT."src/");

//Registry
Registry::channel("Urls")->fill(define_urls(__FILE__));

//Init Modules
require_once CORE_ROOT.'src/ini.php';

//ROUTING
echo Router::make(Registry::channel("Urls")->get("REQUEST_URL"), Registry::channel("Routes")->all());


/*
//Routing with EventManager xD

use CoraPHP\Events\Event;

$url = Registry::channel("Urls")->get("REQUEST_URL");

Event::listenTo("/", function($event, $data){
    Event::trigger("_base", array("content" => "Home Page!"));
});

Event::listenTo("/about", function($event, $data){
    Event::trigger("_base", array("content" => "Admin Page!"));
});

Event::listenTo("_menu", function($event, $data){
    return "<div>menu - menu - menu</div>";
});

Event::listenTo("_base", function($event, $data){
    $output = "<div>Header</div>";
    $output .= Event::trigger("_menu");
    $output .=  "<div>".$data['content']."</div>";
    $output .=  "<div>Footer:{$event}</div>";
    echo $output;
});

//and $data can be user as "Service Locatior / Container" :D

$data = array();

$data['url'] = $url;

Event::trigger($url, $data);

*/