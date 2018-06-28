<?php

namespace Common;

use CoraPHP\Core\Logger;
use CoraPHP\Core\ModuleBase;

class Module extends ModuleBase{

    public function init()
    {
        $logger = Logger::getLogger("Common");

        $logger->info(__METHOD__);
    }
}
