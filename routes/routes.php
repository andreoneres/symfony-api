<?php

use App\Controller\UsersController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes) {
    $routes->add('api_user', '/api/users/{id}')
        ->controller([UsersController::class, 'findOne'])
        ->methods(['GET'])
    ;
    $routes->add('api_users', '/api/users')
        ->controller([UsersController::class, 'findAll'])
        ->methods(['GET'])
    ;
    $routes->add('api_create_users', '/api/users')
        ->controller([UsersController::class, 'create'])
        ->methods(['POST'])
    ;
    $routes->add('api_update_users', '/api/users/{id}')
        ->controller([UsersController::class, 'update'])
        ->methods(['PUT'])
    ;
    $routes->add('api_delete_users', '/api/users/{id}')
        ->controller([UsersController::class, 'delete'])
        ->methods(['DELETE'])
    ;
};