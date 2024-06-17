<?php

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class SlamForm
{
    protected array $errors = [];

    public function __construct(public array $attributes)
    {
        if (!Validator::string($attributes['title'])) {
            $this->errors['title'] = 'Title needs to be at least one character long';
        }

        if (!Validator::string($attributes['content'])) {
            $this->errors['content'] = 'Content needs to be at least one character long';
        }

        if (!Validator::string($attributes['category'])) {
            $this->errors['category'] = 'Tag needs to be selected';
        }
    }


    public static function validate($attributes): static
    {
        $instance = new static($attributes);

        return $instance->failed() ? $instance->throw() : $instance;
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

    public function error($field, $message): SlamForm
    {
        $this->errors[$field] = $message;

        return $this;
    }
}
