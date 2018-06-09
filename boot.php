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
 * string = Default:layout/main
 * 
 * DEFAULT_PATH.Default/view/layout/main.php
 */

session_start();

define('CORE_ROOT', dirname(__FILE__).'/');

require_once CORE_ROOT.'src/Core/Loader.php';

use Core\Loader;

Loader::load();

Loader::enable();

Loader::$DEFAULT_PATH = CORE_ROOT."src/";

use Core\Module;
use Core\Router;
use Core\View;

View::$DEFAULT_PATH = CORE_ROOT."src/";

require_once CORE_ROOT.'app/config/routes.php';

//Register Modules
Module::registerModule(new Main\MainModule());

$url = parse_url(rtrim($_SERVER['REQUEST_URI'],'/'), PHP_URL_PATH);

$router = new Router();

$response = $router->dispatch($url);

echo $response;
