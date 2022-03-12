<?php

namespace PhpMvc\Support;

use ArrayAccess;

class Arr
{


    // this array is array or ArrayAccess typed ? if true then it can be accessed through below methods
    public static function accessible($array): bool
    {
        return is_array($array) || $array instanceof ArrayAccess;
    }

    // this key exists in array given? // internal check
    private static function has_key($array, $key): bool
    {
        if ($array instanceof ArrayAccess) {
            return $array->offsetExists($key);
        }
        return array_key_exists($key, $array);
    }

    // array has key,keys or not ?
    public static function has_keys($array, string|array $keys): bool
    {
        if (!$keys) {
            return false;
        }

        $keys = (array)$keys;
        foreach ($keys as $key) {
            if (static::has_key(array_keys($array), $key)) {
                continue;
            }

            $subArray = $array;
            foreach (explode('.', $key) as $segment) {
                if (static::accessible($subArray) && static::has_key($subArray, $segment)) {
                    $subArray = $subArray[$segment];
                } else {
                    return false;
                }
            }

        }
        return true;
    }

    //TODO handmade
    private static function deep_search(&$array, string $key, string $action = 'get', $value = null)
    {
        $key_parts = explode('.', $key);
        while (count($key_parts) > 1) {
            $key_part = array_shift($key_parts);
            if (isset($array[$key_part]) && is_array($array[$key_part])) {
                $array = &$array[$key_part];
            }
        }
        //key_parts now contains the latest key in sequence , $array is a reference for key_part parent array
        if ($action === 'unset') {
            unset($array[array_shift($key_parts)]);
            return true;
        }

        if ($action === 'set') {
            $array[array_shift($key_parts)] = $value;
            return true;
        }
        if ($action === 'get') {
            return $array[array_shift($key_parts)];
        }
    return false;
    }

    //get all array or specified key,keys
    public static function get($array, array|string $keys = null, $default = null)
    {
        if (is_null($keys)) {
            return $array;
        }
        if (!static::accessible($array)) {
            return value($default);
        }

        $isStringFlag = is_string($keys);
        $keys = (array)$keys;
        $values = [];

        foreach ($keys as $key) {

            if (static::has_key($array, $key)) {
                $values[$key] = value($array[$key]) ?? $default;
                continue;
            }
            if (str_contains($key, '.')) {
                $values[$key] = static::deep_search($array, $key) ?? $default;
                continue;
            }
            $values[$key]=null;
        }

        if ($isStringFlag) {
            return (array_values($values)[0]);
        }
        return $values;

    }

    public static function set(&$array, array $key_value_pairs): bool
    {

        if (empty($key_value_pairs) || !static::accessible($array)) {
            return true;
        }

        $keys = array_keys($key_value_pairs);

        $changed = false;
        foreach ($keys as $key) {
            if (static::has_key($array, $key)) {
                $array[$key] = value($key_value_pairs[$key]);
                $changed = true;
            }
            if (str_contains($key, '.')) {
                $changed = static::deep_search($array, $key, 'set', $key_value_pairs[$key]) ?? $changed;
            }

        }
        return $changed;
    }

    //return all except keys send to function
    public static function get_except($array, $keys)
    {
        static::unset($array, $keys);
        return $array;
    }

    //TODO # to be enhanced avoiding merge function and make true flatten
    public static function flatten(array $array, int $depth = INF): array
    {
        $result = [];

        foreach ($array as $item) {
            if (!is_array($item)) {
                $result[] = $item;
            } elseif ($depth === 1) {
                $result = array_merge($result, array_values($item));
            } else {
                $result = array_merge($result, static::flatten($item, $depth - 1));
            }
        }

        return $result;
    }

    //Unset key or more from sent array #Modified the array sent and if set as db.ggg.ddd exploded and unset
    public static function unset(&$array, array|string $keys): bool
    {
        if (!$keys) {
            return false;
        }

        $unset_done = false;
        foreach ((array)$keys as $key) {
            if (static::has_key($array, $key)) {
                unset($array[$key]);
                $unset_done = true;
                continue;
            }
            // to unset keys as 'db.connection.default'
            $unset_done = static::deep_search($array, $key, 'unset') || $unset_done;
        }
        return $unset_done;
    }

    //returns the last element and optional callable function is applied
    public static function last($array, callable $callable = null, $default = null)
    {
        if (is_null($callable)) {
            return empty($array) ? value($default) : end($array);
        }
        return static::first(array_reverse($array), $callable, $default);
    }

    //returns the first element and optional callable function is applied
    public static function first($array, callable $callable = null, $default = null)
    {
        if (is_null($callable)) {
            return empty($array) ? value($default) : reset($array);
        }
        $key = array_key_first($array);
        $value = $array[$key];
        if ($callable($value, $key)) {
            return $value;
        }
        return $default;

    }
}

