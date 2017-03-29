<?php

require 'vendor/autoload.php';

$app = new \Lime\App();

// setup latte templating engine
$latte = new \Latte\Engine();
$latte->setTempDirectory(__DIR__ . '/temp');
$app['latte'] = $latte;

return $app;