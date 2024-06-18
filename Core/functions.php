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

function currentURL($without = null): string
{
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";

    $host = $_SERVER['HTTP_HOST'];

    (isset($without) ? $path = removeParamURI($without) : $path = $_SERVER['REQUEST_URI']);

    return $protocol . "://" . $host . $path;
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

function code($value): string
{
    $value = preg_replace('/\*\*([^*]+)\*\*/', '<span class="fw-bold">$1</span>', $value);
    $value = preg_replace('/\*([^*]+)\*/', '<span class="fst-italic">$1</span>', $value);
    $value = preg_replace('/~~([^~]+)~~/', '<span class="text-decoration-line-through">$1</span>', $value);
    $value = preg_replace('/_([^_]+)_/', '<span class="text-decoration-underline">$1</span>', $value);
    $value = preg_replace('/`([^`]+)`/', '<span class="bg-secondary-subtle text-dark px-1" style="font-family:Consolas,serif">$1</span>', $value);
    return $value;
}

function postFormat($value): string
{
    return nl2br(code(htmlspecialchars($value)));
}

function old($key, $default = '')
{
    return Session::get('old')[$key] ?? $default;
}
