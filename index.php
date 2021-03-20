<?php

require_once __DIR__.'/vendor/autoload.php';
use app\core\Application;

$app = new Application();

$app->router->get('/', function(){
    return 'Olá Mundo!';
});

$app->router->get('/contato', function(){
    return 'Contato!';
});

$app->run();