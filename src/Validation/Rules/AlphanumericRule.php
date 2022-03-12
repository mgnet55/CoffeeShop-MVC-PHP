<?php

namespace PhpMvc\Validation\Rules;

use PhpMvc\Validation\Rules\Contract\Rule;

class AlphanumericRule implements Rule
{


    public function apply($field,$value,$data):bool    {
        return preg_match('/^[a-zA-Z0-9]+$/',$value);
    }

    public function __toString(): string
    {
        return "% accepts only characters and numbers";
    }
}