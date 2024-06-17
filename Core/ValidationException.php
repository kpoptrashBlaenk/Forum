<?php

namespace Core;

class ValidationException extends \Exception
{
    public readonly array $errors;
    public readonly array $old;

    public static function throw($errors, $old): void
    {
        $instance = new static;

        $instance->errors = $errors;
        $instance->old = $old;

        throw $instance;
    }
}
