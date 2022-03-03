<?php

use \Twig\Loader\FilesystemLoader;
use \Twig\Environment;
use \App\Facade\FileImport;
use \App\Service\Container\Container;

$templatePath = FileImport::generatePath('src/View');
$cachePath = FileImport::generatePath('cache/template');

$loader = new FilesystemLoader($templatePath);
$twig = new Environment($loader, [
    'cache' => false,
]);

Container::bind('view', $twig);

