<?php

error_reporting(E_ALL);
session_start();

define('CORE_ROOT', str_replace("\\","/", dirname(__DIR__).'/'));

define('SYSTEM_ROOT', CORE_ROOT."system/");
define('MODULE_ROOT', CORE_ROOT."src/");

//Requires
require_once SYSTEM_ROOT."functions.php";

fake_loader(":log", false);
fake_loader(":register");
fake_loader(":addPath", SYSTEM_ROOT);
fake_loader(":addPath", MODULE_ROOT);

//Uses
use CoraPHP\Core\Console;
use CoraPHP\Core\Logger;
use CoraPHP\Core\FileSystem;
use CoraPHP\Core\ModuleBase;

use CoraPHP\Container\Registry;

use CoraPHP\Http\Router;

//Logger
Logger::enabled(false);

//FileSystem
FileSystem::addPath(MODULE_ROOT);

//Registry
Registry::channel("Urls")->fill(define_urls(__FILE__));

//Init Modules
ModuleBase::loadModule(CORE_ROOT."src/");

//ROUTING
echo Router::make(Registry::channel("Urls")->get("REQUEST_URL"), Registry::channel("Routes")->all());

//Console::createModule("Admin", MODULE_ROOT);

//include CORE_ROOT."test.php";