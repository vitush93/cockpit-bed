<?php

return [
    'tempDir' => __DIR__ . '/temp',
    'database' => [
        'dsn' => 'mysql:host=localhost;dbname=database',
        'user' => 'root',
        'password' => '',
        'options' => [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        ]
    ],
    'lang' => ['cs', 'en'],
    'langDefault' => ['cs']
];