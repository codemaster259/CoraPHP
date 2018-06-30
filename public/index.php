<?php

error_reporting(E_ALL);
session_start();

define('CORE_ROOT', str_replace("\\","/", dirname(__DIR__).'/'));

define('SYSTEM_ROOT', CORE_ROOT."system/");
define('APP_ROOT', CORE_ROOT."app/");

//Requires
require_once SYSTEM_ROOT."functions.php";

//fake_loader(":log", true);
fake_loader(":register");
fake_loader(":addPath", CORE_ROOT);

//Uses

use System\CoraPHP\Core\App;
use System\CoraPHP\Core\Logger;
use System\CoraPHP\Core\FileSystem;
use System\CoraPHP\Core\ModuleBase;

use System\CoraPHP\Container\Registry;
use System\CoraPHP\Container\Injecter;

use System\CoraPHP\Http\Router;

use System\CoraPHP\Model\Database;
use System\CoraPHP\Model\ModelFactory;

$app = new App();

$app->onPrepare(function(App $app){
    
    //Logger
    Logger::enabled(false);

    //FileSystem
    FileSystem::addPath(APP_ROOT);
    FileSystem::addPath(CORE_ROOT);

    //Registry
    Registry::channel("Urls")->fill(define_urls(__FILE__));

    //Init App   
    include APP_ROOT."ini.php";

    //dependences???
    $injecter = new Injecter();


    $injecter->add("dbsettings", function(Injecter $i){

        return Registry::channel("Database")->get("MySQL");
    });

    $injecter->add("database", function(Injecter $i){

        extract($i->get("dbsettings"));
        return new Database($host, $user, $pass, $dbname);
    });
    
    $injecter->add("ModelFactory", function(Injecter $i){
        
        return new ModelFactory($i->get("database"));
    });
   
    $app->add("injecter", $injecter);
    
});

$app->onLoad(function(App $app){
    
    //ROUTING
    echo Router::make(Registry::channel("Urls")->get("REQUEST_URL"), Registry::channel("Routes")->all(), $app->get("injecter"));

    //debug(Router::getRoutes());
    
    //use System\CoraPHP\Core\Console;

    //Console::createModule("Admin", MODULE_ROOT);

    //include CORE_ROOT."test.php";
});

$app->load();
