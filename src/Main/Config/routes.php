<?php
//src/Main/Config/routes.php

use CoraPHP\Router;

Router::register('main_default_index', array(
                    "route" => "/",
                    "path" => "Main:Default:index"
                    ));

Router::register('main_default_test', array(
                    "route" => "/test",
                    "path" => "Main:Default:test"
                    ));

Router::register('main_widget_sidebar', array(
                    "route" => "/widget/sidebar",
                    "path" => "Main:Widget:sidebar"
                    ));

Router::register('main_widget_menu', array(
                    "route" => "/widget/menu",
                    "path" => "Main:Widget:menu"
                    ));
