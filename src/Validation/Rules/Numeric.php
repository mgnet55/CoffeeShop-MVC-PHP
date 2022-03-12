<?php

namespace PhpMvc\Validation\Rules;

class Numeric implements Contract\Rule
{

    public function apply($field, $value, $data): bool
    {
        return is_numeric($value);
    }

    public function __toString(): string
    {
        return "% must be a number";
    }
}