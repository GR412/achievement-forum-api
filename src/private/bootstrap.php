<?php

// Specify domains from which requests are allowed
//header('Access-Control-Allow-Origin: *');

// Specify which request methods are allowed
//header('Access-Control-Allow-Methods: GET, POST, OPTIONS');

// Additional headers which may be sent along with the CORS request
// The X-Requested-With header allows jQuery requests to go through
//header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

// Set the age to 1 day to improve speed/caching.
//header('Access-Control-Max-Age: 86400');

require __DIR__ . '/../../vendor/autoload.php'; // get required slim settings

$settings = require __DIR__ . '/app/settings.php'; // get the app settings

$container = new Slim\Container($settings); // create a new slim container with the app settings

require __DIR__ . '/app/dependencies.php'; // get all the required dependencies of the app

$app = new Slim\App($container); // create a new slim app with the provided container

require __DIR__ . '/app/routes.php'; // get all of the routes used in the app

try {
    $app->run();
} catch (Throwable $e) {
} // run the slim app
