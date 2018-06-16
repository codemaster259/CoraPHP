<?php

namespace Common;

use CoraPHP\Core\Logger;
use CoraPHP\Core\Module;

class CommonModule extends Module{

    public function init()
    {
        $logger = Logger::getLogger("Common");

        $logger->info(__METHOD__);
    }
}
