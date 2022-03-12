<?php
namespace PhpMvc\Validation\Rules;

use PhpMvc\Validation\Rules\Contract\Rule;

class RequiredRule implements Rule{

    public function apply($field,$value,$data):bool    {
        return !($value === null || trim($value) === '');
    }

    public function __toString(): string
    {
        return "% is required";
    }
}