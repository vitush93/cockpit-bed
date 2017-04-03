<?php

require 'vendor/autoload.php';

$container = new \Slim\Container();
$app = new \Slim\App($container);

$container['config'] = function ($container) {
    return include 'config.php';
};

$container['dbconnection'] = function ($container) {
    $dbConfig = $container['config']['database'];

    return new \Nette\Database\Connection($dbConfig['dsn'], $dbConfig['user'], $dbConfig['password'], $dbConfig['options']);
};

$container['storage'] = function ($container) {
    return new \Nette\Caching\Storages\FileStorage($container['config']['tempDir']);
};

$container['dbstructure'] = function ($container) {
    return new \Nette\Database\Structure($container['dbconnection'], $container['storage']);
};

$container['db'] = function ($container) {
    return new \Nette\Database\Context($container['dbconnection'], $container['dbstructure']);
};

$container['latte'] = function ($container) {
    $tempDirectory = $container['config']['tempDir'];

    $latte = new \Latte\Engine();
    $latte->setTempDirectory($tempDirectory);

    return $latte;
};

if (in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1'])) {
    $container['settings']['displayErrorDetails'] = true;
}

$container['lang'] = function ($container) {
    if (isset($_SESSION['app']['lang'])) {
        return $_SESSION['app']['lang'];
    } else {
        return $container['config']['langDefault'];
    }
};

return $app;