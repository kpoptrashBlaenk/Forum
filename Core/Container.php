<?php

namespace Core;

class Container
{

    protected array $bindings = [];

    public function bind($key, $function): void
    {
        $this->bindings[$key] = $function;
    }

    public function resolve($key)
    {
        if (!array_key_exists($key, $this->bindings)) {
            throw new \Exception("No binding found for this{$key}");
        }

        $function = $this->bindings[$key];

        return $function();
    }

}
