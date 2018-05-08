<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        //Data Base
        // Slim Settings
        'determineRouteBeforeAppMiddleware' => false,
         'db' => [
                    'driver' => 'mysql',
                    'host' => 'localhost',
                    'database' => 'bd_clientes',
                    'username' => 'root',
                    'password' => 'Alastor9792+',
                    'charset'   => 'utf8',
                    'collation' => 'utf8_spanish_ci',
                    'prefix'    => '',
         ]

    ],
];
