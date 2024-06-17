<?php

use Core\Response;
use JetBrains\PhpStorm\NoReturn;
use Core\Session;

#[NoReturn] function dd($value): void
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die();
}

#[NoReturn] function abort($code): void
{
    http_response_code($code);
    require basePath("views/partials/$code.php");
    die();
}

function authorize($condition, $status = Response::FORBIDDEN): void
{
    if (!$condition) {
        abort($status);
    }
}

#[NoReturn] function redirect($path): void
{
    header("Location: {$path}");
    exit();
}

function view($path, $attributes = []): void
{
    extract($attributes);
    require basePath('views/' . $path);
}

function basePath($path): string
{
    return BASE_PATH . $path;
}

function resources($path): string
{
    return 'resources/' . $path;
}

function uriCheck($value): bool
{
    return $_SERVER['REQUEST_URI'] === $value;
}

function uriPathCheck($value): bool
{
    return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) === $value;
}

function pageURL($key): string
{
    return removeDuplicateURL('page', $key ?? 1);
}

function currentURL(): string
{
    return $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

function removeDuplicateURL($key, $value): string
{
    $parsedURL = parse_url($_SERVER['REQUEST_URI']);
    parse_str($parsedURL['query'] ?? '', $queryParams);
    unset($queryParams[$key]);
    $query = http_build_query($queryParams);
    return "{$parsedURL['path']}?{$query}&{$key}={$value}";
}

function removeParamURL($key): string
{
    $parsedURL = parse_url($_SERVER['REQUEST_URI']);
    parse_str($parsedURL['query'] ?? '', $queryParams);
    unset($queryParams[$key]);
    $query = http_build_query($queryParams);
    return "{$parsedURL['path']}?{$query}";
}

function old($key, $default = '')
{
    return Session::get('old')[$key] ?? $default;
}
