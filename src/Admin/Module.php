<?php

namespace Admin;

use CoraPHP\Core\Logger;
use CoraPHP\Core\ModuleBase;
use CoraPHP\Container\Registry;
use CoraPHP\Container\ArrayLoader;

class Module extends ModuleBase{

    public function init()
    {
        $logger = Logger::getLogger("Admin");

        $logger->info(__METHOD__);

        Registry::channel("Routes")->fill(ArrayLoader::load(CORE_ROOT."src/Admin/Config/routes.ini"));
    }
}