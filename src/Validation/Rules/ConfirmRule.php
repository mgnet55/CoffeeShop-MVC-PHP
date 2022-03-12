<?php

namespace PhpMvc\Validation\Rules;

class ConfirmRule implements Contract\Rule
{

    public function apply($field,$value,$data):bool    {
        return $data[$field] === $data[$field.'_confirmation'];
    }

    public function __toString(): string
    {
        return "% doesn't match with % confirmation";
    }
}