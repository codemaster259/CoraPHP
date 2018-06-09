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

require_once CORE_ROOT.'src/Core/Loader.php';

use Core\Loader;
use Core\Module;
use Core\Router;
use Core\View;
use Core\Bucket;

Loader::load();
//Loader::enableLog();
Loader::$DEFAULT_PATH = CORE_ROOT."src/";

View::$DEFAULT_PATH = CORE_ROOT."src/";



$bucket = new Bucket("main");

$bucket->set("lang", new Core\Lang());
$bucket->set("lang", new Core\Lang());

Router::setBucket($bucket);

require_once CORE_ROOT.'app/config/routes.php';

//Register Modules
Module::registerModule(new Main\MainModule());

$url = parse_url(rtrim($_SERVER['REQUEST_URI'],'/'), PHP_URL_PATH);

$router = new Router();

$response = $router->dispatch($url);

echo $response;
