<?php

namespace PhpMvc\Support;

class Config implements \ArrayAccess
{
    protected array $configs = [];


    public function __construct($items)
    {
        foreach ($items as $key => $item) {
            $this->configs[$key] = $item;
        }
    }

//default methods of ArrayAccess class
    public function offsetExists(mixed $offset): bool
    {
        return Arr::has_keys($this->configs,$offset);
    }

    public function offsetGet(mixed $key, $default = null)
    {
        return Arr::get($this->configs, $key, $default);
    }

    public function offsetSet(mixed $key, mixed $value = null): bool
    {
        if (is_array($key)) {
            return Arr::set($this->configs, $key);
        }
        if (is_string($key)) {
            return Arr::set($this->configs, [$key => $value]);
        }
        return false;
    }

    public function offsetUnset(mixed $key)
    {
        return Arr::unset($this->configs,$key);
    }

    public function getMany(array $keys)
    {
        return Arr::get($this->configs, $keys);
        $config = [];
        foreach ($keys as $key => $default) {
            if (is_numeric($key)) {
                //swap with array destructing
                [$key, $default] = [$default, null];
            }
            $config[$key] = Arr::get($this->configs, $key, $default);
        }
        return $config;
    }

}