<?php


//Routing with EventManager xD

use CoraPHP\Events\Event;
use CoraPHP\Container\Registry;

$url = Registry::channel("Urls")->get("REQUEST_URL");

Event::listenTo("/", function($event, $data){
    Event::trigger("_base", array("content" => "Home Page!"));
});

Event::listenTo("/about", function($event, $data){
    Event::trigger("_base", array("content" => "Admin Page!"));
});

Event::listenTo("_menu", function($event, $data){
    return "<div>menu - menu - menu</div>";
});

Event::listenTo("_base", function($event, $data){
    $output = "<div>Header</div>";
    $output .= Event::trigger("_menu");
    $output .=  "<div>".$data['content']."</div>";
    $output .=  "<div>Footer:{$event}</div>";
    echo $output;
});

//and $data can be user as "Service Locatior / Container" :D

$data = array();

$data['url'] = $url;

Event::trigger($url, $data);


