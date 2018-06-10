<?php

namespace CoraPHP;

class ErrorController extends Controller{
    
    public function indexAction()
    {
        $url = $this->request->attributes->get('_url');
        $this->response->body("Page <b>{$url}</b> not found");
    }
}