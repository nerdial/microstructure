<?php

use App\Service\Container\Container;
use Twig\Environment;
use Monolog\Logger;

if (!function_exists('view')) {
    function view(): Environment
    {
        return Container::get('view');
    }
}

if (!function_exists('logger')) {
    function logger(): Logger
    {
        return Container::get('log');
    }
}