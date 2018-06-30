<?php

use System\CoraPHP\Core\Logger;

use System\CoraPHP\Container\Registry;
use System\CoraPHP\Container\ArrayLoader;

use App\Service\MessageService;

$logger = Logger::getLogger("App");

$logger->info(__METHOD__);

Registry::channel("Routes")->fill(ArrayLoader::load(APP_ROOT."Config/routes.ini"));

Registry::channel("Settings")->fill(ArrayLoader::load(APP_ROOT."Config/settings.ini"));

Registry::channel("Database")->fill(ArrayLoader::load(APP_ROOT."Config/database.ini"));

$database = Registry::channel("Database")->all();

Registry::channel("Library")->set("App:Service:MessageService", new MessageService());