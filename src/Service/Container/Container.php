<?php

namespace App\Service\Container;

class Container
{
    private static array $stack = [];

    public static function bind(string $name, $object)
    {
        if (isset(static::$stack[$name])) {
            return static::$stack[$name];
        }

        return static::$stack[$name] = $object;
    }

    public static function exist(string $name): bool
    {
        return (isset(static::$stack[$name]));
    }

    public static function get(string $name)
    {
        if (!isset(static::$stack[$name])) {
            throw new \InvalidArgumentException('Such service does not exists in the container');
        }

        return static::$stack[$name];
    }
}
