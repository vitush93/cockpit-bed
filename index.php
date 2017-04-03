<?php

session_start();

require 'vendor/autoload.php';

use Slim\Http\Request;
use Slim\Http\Response;

/** @var \Slim\App $app */
$app = require 'bootstrap.php';

$app->add(function (Request $request, Response $response, callable $next) {
    $lang = $request->getParam('lang');

    if ($lang && in_array($lang, $this->config['lang'])) {
        $_SESSION['app']['lang'] = $lang;
    }

    return $next($request, $response);
});

$app->get('/', function (Request $request, Response $response) {
    return $this->latte->renderToString('templates/home.latte');
});

$app->get('/scss/{file}', function (Request $request, Response $response) {
    $file = $request->getAttribute('file');
    $_GET['p'] = $file;

    \Leafo\ScssPhp\Server::serveFrom('assets/scss');

    die;
});

$app->run();