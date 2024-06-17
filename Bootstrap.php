<?php

use Core\App;
use Core\Container;
use Core\Database;

$container = new Container();

$container->bind(Database::class, function () {
    $config = require basePath('config.php');
    return new Database($config['Database']);
});

$db = $container->resolve(Database::class);

App::setContainer($container);
