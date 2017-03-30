<?php

require 'vendor/autoload.php';

use Slim\Http\Request;
use Slim\Http\Response;

/** @var \Slim\App $app */
$app = require 'bootstrap.php';

$app->get('/', function (Request $request, Response $response) {
    return $this->get('latte')->renderToString('templates/home.latte');
});

$app->get('/scss/{file}', function (Request $request, Response $response) {
    $file = $request->getAttribute('file');
    $_GET['p'] = $file;

    \Leafo\ScssPhp\Server::serveFrom('assets/scss');

    die;
});

$app->run();