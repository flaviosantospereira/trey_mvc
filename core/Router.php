<?php

namespace app\core;

class Router
{
    public array $routes = [];
    public function get($path, $callback)
    {
        //var_dump($this->routes);
        $this->routes['get'][$path] = $callback;
    }
    public function resolve()
    {
        echo '<pre>';
        var_dump($_SERVER);
        echo '</pre>';
        exit;
    }
}