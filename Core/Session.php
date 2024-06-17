<?php

namespace Core;

class Session
{

    public static function has($key): bool
    {
        return (bool)static::get($key);
    }

    public static function put($key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    public static function get($key, $default = [])
    {
        return $_SESSION['_flashed'][$key] ?? $_SESSION[$key] ?? $default;
    }

    public static function flash($key, $value): void
    {
        $_SESSION['_flashed'][$key] = $value;
    }

    public static function unflash(): void
    {
        unset($_SESSION['_flashed']);
    }

    public static function flush(): void
    {
        $_SESSION = [];
    }

    public static function destroy(): void
    {
        static::flush();

        session_destroy();

        $params = session_get_cookie_params();
        setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
}
