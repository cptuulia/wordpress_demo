<?php

/** @var Bramus\Router\Router $router */

$router->mount('/api', function () use ($router) {
    // Define routes here
    $router->get('/test', Kamergro\Controllers\IndexController::class . '@test');
    $router->get('/', Kamergro\Controllers\IndexController::class . '@test');

    $router->get('/categories', Kamergro\Controllers\CategoryController::class . '@index');
    $router->post('/categories', Kamergro\Controllers\CategoryController::class . '@store');
    $router->put('/categories', Kamergro\Controllers\CategoryController::class . '@update');
    $router->get('/categories/(\d+)', Kamergro\Controllers\CategoryController::class . '@show');
    $router->delete('/categories/(\d+)', Kamergro\Controllers\CategoryController::class . '@destroy');

    $router->get('/items/category/(\d+)', Kamergro\Controllers\ItemController::class . '@index');
    $router->post('/items', Kamergro\Controllers\ItemController::class . '@store');
    $router->put('/items', Kamergro\Controllers\ItemController::class . '@update');
    $router->get('/items/(\d+)', Kamergro\Controllers\ItemController::class . '@show');
    $router->delete('/items/(\d+)', Kamergro\Controllers\ItemController::class . '@destroy');

    $router->get('/medias', Kamergro\Controllers\MediaController::class . '@index');
    $router->post('/medias', Kamergro\Controllers\MediaController::class . '@store');
    $router->put('/medias', Kamergro\Controllers\MediaController::class . '@update');
    $router->get('/medias/(\d+)', Kamergro\Controllers\MediaController::class . '@show');
    $router->delete('/medias/(\d+)', Kamergro\Controllers\MediaController::class . '@destroy');

    $router->get('/slogan/category', Kamergro\Controllers\SloganCategoryController::class . '@index');
    $router->get('/slogan/category/(\d+)', Kamergro\Controllers\SloganCategoryController::class . '@show');
    $router->post('/slogan/category', Kamergro\Controllers\SloganCategoryController::class . '@store');
    $router->put('/slogan/category', Kamergro\Controllers\SloganCategoryController::class . '@update');
    $router->delete('/slogan/category/(\d+)', Kamergro\Controllers\SloganCategoryController::class . '@destroy');

    $router->get('/slogan', Kamergro\Controllers\SloganController::class . '@index');
    $router->get('/slogan/(\d+)', Kamergro\Controllers\SloganController::class . '@show');
    $router->post('/slogan', Kamergro\Controllers\SloganController::class . '@store');
    $router->put('/slogan', Kamergro\Controllers\SloganController::class . '@update');
    $router->delete('/slogan/(\d+)', Kamergro\Controllers\SloganController::class . '@destroy');
    
});
