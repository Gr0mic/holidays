<?php
/**
 * Created by PhpStorm.
 * User: Gromic
 * Date: 09/12/2016
 * Time: 11:00
 */

return [
    'settings' => [
        'addContentLengthHeader' => false,
        'displayErrorDetails' => true,

        'view' => [
            'template_path' => __DIR__ . '/Views',
            'twig' => [
                'cache' => __DIR__ . '/../tmp/cache/twig',
                'debug' => true,
                'auto_reload' => true,
            ],
        ],

        'db' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'holidays',
            'username' => 'root',
            'password' => 'root',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ],

    ]
];