<?php

error_reporting(E_ALL);
session_start();

define('CORE_ROOT', str_replace("\\","/", dirname(__DIR__).'/'));
define('SYSTEM_ROOT', CORE_ROOT."System/");
define('APP_ROOT', CORE_ROOT."App/");

//Requires
require_once SYSTEM_ROOT."functions.php";

//fake_loader(":log", true);
fake_loader(":addPath", CORE_ROOT);
fake_loader(":register");


//Uses
use System\CoraPHP\Core\App;
use System\CoraPHP\Core\Logger;
use System\CoraPHP\Core\FileSystem;

use System\CoraPHP\Container\Config;
use System\CoraPHP\Container\Registry;
use System\CoraPHP\Container\Injecter;

use System\CoraPHP\Http\Router;

use System\CoraPHP\Model\Database;
use System\CoraPHP\Model\ModelFactory;
use System\CoraPHP\Model\EntityManager;

$app = new App();

$app->onLoad(function(App $app){

    //Logger
    Logger::enabled(false);
    
    //Init App
    Logger::getLogger("App")->info(__METHOD__);

    //FileSystem
    //FileSystem::enableLog();
    FileSystem::addPath(CORE_ROOT);
    FileSystem::addPath(APP_ROOT);

    //Registry
    Registry::channel("Urls")->fill(define_urls(__FILE__));

    Registry::channel("Routes")->fill(Config::load(APP_ROOT."Config/routes.ini"));

    Registry::channel("Settings")->fill(Config::load(APP_ROOT."Config/settings.ini"));
    
    Registry::channel("Database")->fill(Config::load(APP_ROOT."Config/database.ini"));

    Registry::channel("Library")->set("App:Service:MessageService", new \App\Service\MessageService());

    //Dependences!!!
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
    
    $injecter->add("EntityManager", function(Injecter $i){
        
        return new EntityManager($i->get("database"));
    });
    
    //ROUTING
    echo Router::make(Registry::channel("Urls")->get("REQUEST_URL"), Registry::channel("Routes")->all(), $injecter);

    //debug(Router::getRoutes());
});

try{
    $app->load();
} catch (Exception $e){
    
    debug($e->getMessage());
}

//use System\CoraPHP\Core\Console;

//Console::createModule("App", MODULE_ROOT);

//include CORE_ROOT."test.php";