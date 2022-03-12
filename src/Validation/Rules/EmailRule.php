<?php

namespace PhpMvc\Validation\Rules;

class EmailRule implements Contract\Rule
{

    public function apply($field,$value,$data):bool
    {
        return preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $value);
    }
    public function __toString(): string
    {
        return "% is not valid email";
    }
}