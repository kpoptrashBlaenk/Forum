<?php

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class LoginForm
{
    protected array $errors = [];

    public function __construct(public array $attributes)
    {
        if (!Validator::email($attributes['email'])) {
            $this->errors['email'] = 'Email not valid';
        }

        if (!Validator::string($attributes['password'])) {
            $this->errors['password'] = 'Password not valid';
        }

        if (isset($attributes['username']) && !Validator::string($attributes['username'])) {
            $this->errors['username'] = 'Username not valid';
        }
    }


    public static function validate($attributes): static
    {
        $instance = new static($attributes);

        return $instance->failed() ? $instance->throw() : $instance;
    }

    public static function emailExists($attributes): static
    {
        $instance = new static($attributes);

        $instance->errors['email'] = 'Email already exists';



        return $instance->throw();
    }

    public static function usernameExists($attributes): static
    {
        $instance = new static($attributes);

        $instance->errors['username'] = 'Username already exists';

        return $instance->throw();
    }

    public function throw(): void
    {
        ValidationException::throw($this->errors(), $this->attributes);
    }

    public function failed(): int
    {
        return count($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function error($field, $message): LoginForm
    {
        $this->errors[$field] = $message;

        return $this;
    }
}
