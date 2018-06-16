<?php
//MAIN

namespace Main;

use CoraPHP\Core\Logger;
use CoraPHP\Core\Module;

use CoraPHP\Container\Registry;
use CoraPHP\Container\ArrayLoader;

use CoraPHP\Model\Database;

use Main\Service\MessageService;

class MainModule extends Module{

    public function init()
    {
        $logger = Logger::getLogger("Main");

        $logger->info(__METHOD__);

        Registry::channel("Routes")->fill(ArrayLoader::load(CORE_ROOT."src/Main/Config/routes.ini"));
        
        Registry::channel("Settings")->fill(ArrayLoader::load(CORE_ROOT."src/Main/Config/settings.ini"));
        
        Registry::channel("Database")->fill(ArrayLoader::load(CORE_ROOT."src/Main/Config/database.ini"));

        $database = Registry::channel("Database")->all();
        
        Registry::channel("Services")->set("database", new Database($database['MySQL']));
        
        Registry::channel("Library")->set("Main:Service:MessageService", new MessageService());
    }
}

