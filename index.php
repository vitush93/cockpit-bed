<?php

define('TEMPLATE_DIR', __DIR__ . '/templates');
define('SCSS_DIR', __DIR__ . '/assets/scss');

/** @var \Lime\App $app */
$app = require 'bootstrap.php';

// Homepage
$app->get('/', function () use ($app) {
    return $app['latte']->renderToString(TEMPLATE_DIR . '/home.latte');
});

// Automatic SASS compilation
$app->bind('/css/:file', function ($params) use ($app) {
    $parts = pathinfo($params['file']);
    if (!isset($parts['extension']) || $parts['extension'] != 'scss') {
        $_GET['p'] = $params['file'] . '.scss';
    }

    \Leafo\ScssPhp\Server::serveFrom(SCSS_DIR);

    $app->stop();
});

$app->run();