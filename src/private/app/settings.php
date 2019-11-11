<?php

// development: change to - on, on
ini_set('display_errors', 'On'); // display errors on the page
ini_set('html_errors', 'On'); // display html errors on the page
ini_set('xdebug.trace_output_name', 'private.%t'); // TODO find out what this is

define('DIRSEP', DIRECTORY_SEPARATOR); // define a string to define a directory separator constant

// development: change to - true, true, development, true
$settings = [
    "settings" => [
        'displayErrorDetails' => true, // detailed errors are helpful
        'addContentLengthHeader' => false, // TODO find out what this does
        'mode' => 'development', // ensure the app is in development mode
        'debug' => true, // TODO find out what this does
        'class_path' => __DIR__ . '/src/', // TODO find out what this does
        'pdo' => [ // pdo configuration array
            'type' => 'mysql', // database type
            'host' => 'localhost', // host location
            'name' => 'achievement_forum', // database name
            'port' => '3306', // port number
            'user_name' => 'root', // phpMyAdmin default username
            'user_password' => '', // phpMyAdmin default password
            'charset' => 'utf8', // TODO not sure if i need
            'collation' => 'utf8_unicode_ci', // TODO not sure if i need
            'options' => [ // pdo specific attributes
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // throws pdo exceptions
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => true, // allows emulation of prepared statements
            ],
        ]
    ],
];

return $settings; // return the settings array
