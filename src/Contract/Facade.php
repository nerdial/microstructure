<?php

namespace App\Contract;

abstract class Facade
{
    abstract protected static function getAccessor(): ServiceInterface;

    public static function __callStatic($method, $args)
    {
        $instance = static::getAccessor();

        return $instance->$method(...$args);
    }
}
