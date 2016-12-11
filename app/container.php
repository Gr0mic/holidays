<?php
/**
 * Created by PhpStorm.
 * User: Gromic
 * Date: 09/12/2016
 * Time: 11:03
 */

$container = $app->getContainer();

// Service factory for the ORM
$capsule = new \Illuminate\Database\Capsule\Manager();
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();


$container[App\WidgetController::class] = function ($container) {
    $view = $container->get('view');
    $logger = $container->get('logger');
    $table = $container->get('db')->table('table_name');
    return new \App\WidgetController($view, $logger, $table);
};

$container['view'] = function ($container) {
    $settings = $container->get('settings');
    $view = new \Slim\Views\Twig($settings['view']['template_path'], $settings['view']['twig']);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));
    $view->addExtension(new Knlv\Slim\Views\TwigMessages( new Slim\Flash\Messages() ));

    return $view;
};

$container['flash'] = function () {
    return new \Slim\Flash\Messages();
};