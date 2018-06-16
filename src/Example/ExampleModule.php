<?php

namespace Example;

use CoraPHP\Core\Logger;
use CoraPHP\Core\Module;
use CoraPHP\Container\Registry;
use CoraPHP\Container\ArrayLoader;

class ExampleModule extends Module{

    public function init()
    {
        $logger = Logger::getLogger("Example");

        $logger->info(__METHOD__);

        Registry::channel("Routes")->fill(ArrayLoader::load(CORE_ROOT."src/Example/Config/routes.ini"));
        Registry::channel("Settings")->fill(ArrayLoader::load(CORE_ROOT."src/Example/Config/settings.ini"));
    }
}
