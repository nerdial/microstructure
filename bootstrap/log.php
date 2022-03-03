<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use \App\Service\Container\Container;
use \App\Facade\FileImport;

// create a log channel

$logPath = FileImport::generatePath('cache/log/main.log');
$log = new Logger('microstructure');
$log->pushHandler(new StreamHandler($logPath, Logger::WARNING));

Container::bind('log', $log);

