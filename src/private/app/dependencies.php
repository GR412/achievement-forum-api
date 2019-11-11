<?php

$container['Database'] = function ($container) // database connection
{
    $db = $container['settings']['pdo']; // find the database configuration in the settings.php, settings array
    $pdo = null;

    try // try to create a pdo object with the database settings
    {
        $pdo = new PDO($db['type'] . ':host=' . $db['host'] . ';port=' . $db['port'] . ';dbname=' . $db['name'],
            $db['user_name'], $db['user_password'], $db['options']);

    }
    catch(PDOException $exception) // if it fails then display an exception
    {
        trigger_error('error connecting to database');
    }

    return $pdo; // return the newly created pdo object
};

$container['AuthenticationController'] = function ($c)
{
    $authenticationService = $c->get("AuthenticationService");
    return new App\Controllers\AuthenticationController($authenticationService);
};

$container['AuthenticationService'] = function ($c)
{
    $userMapper = $c->get("UserMapper");
    return new App\Services\AuthenticationService($userMapper);
};

$container['UserMapper'] = function ($c)
{
    $database = $c->get("Database");
    return new App\DataMappers\UserMapper($database);
};
