<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

session_start();

$settings = require __DIR__ . '/../app/settings.php';

$app = new \Slim\App($settings);

require ('../app/container.php');

//MiddleWare
$container = $app->getContainer();
//$app->add(new \App\Middleware\TwigCsrfMiddleware($container->view->getEnvironment(), $container->csrf));
//$app->add($container->get('csrf'));

$app->get('/', \App\Controllers\PagesController::class . ':home');
$app->get('/categories', \App\Controllers\categoriesController::class . ':home')->setName('categories');
$app->get('/categories/add', \App\Controllers\categoriesController::class . ':add')->setName('categories/add');
$app->post('/categories/add', \App\Controllers\categoriesController::class . ':add')->setName('categories/add');

$app->run();