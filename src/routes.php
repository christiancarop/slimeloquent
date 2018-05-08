<?php

use Controllers\UserController;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

// Routes

$app->get('/[{name}]', function (Request $request, Response $response, array $args){
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");
    echo 'Welcome to Api';

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

$app->group('/api' , function() use($app){

    $app->group('/users' , function() use($app){
        //Patrón de las api, el padre va en plural, los métodos van como sigue:
        $this->get('', UserController::class.':list')->setName('list-users');
        $this->get('/{id:[0-9+]}', UserController::class.':get')->setName('get-user');
        $this->post('', UserController::class.':add')->setName('add-users');
        $this->put('/{id:[0-9+]}', UserController::class.':update')->setName('update-users');
        $this->delete('/{id:[0-9+]}', UserController::class.':delete')->setName('delete-users');
    });


});