<?php

namespace Core;

class App
{

    protected static $container;

    public static function setContainer($container): void
    {
        static::$container = $container;
    }

    public static function container()
    {
        return static::$container;
    }

    public static function bind($key, $function): void
    {
        static::container()->bind($key, $function);
    }

    public static function resolve($key)
    {
        return static::container()->resolve($key);
    }

    public function getDB() {
        return self::resolve(Database::class);
    }

}
