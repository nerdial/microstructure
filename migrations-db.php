<?php

$dotenv = Dotenv\Dotenv::createImmutable(realpath('.'));
$dotenv->load();



return [
    'dbname' => $_ENV['DB_DATABASE'],
    'user' => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASSWORD'],
    'host' => $_ENV['DB_HOST'],
    'driver' => 'pdo_sqlite',
    'memory' => true,
];

