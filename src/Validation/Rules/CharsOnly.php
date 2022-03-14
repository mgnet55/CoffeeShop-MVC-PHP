<?php

namespace PhpMvc\Validation\Rules;

use PhpMvc\Validation\Rules\Contract\Rule;

class CharsOnly implements Rule
{


    public function apply($field,$value,$data):bool    {
        return preg_match('/^[a-zA-Z ]*$/',$value);
    }

    public function __toString(): string
    {
        return "% accepts only characters";
    }
}