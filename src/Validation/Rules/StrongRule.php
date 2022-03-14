<?php

namespace PhpMvc\Validation\Rules;

use PhpMvc\Validation\Rules\Contract\Rule;

class StrongRule implements Rule
{

    public function apply($field, $value, $data): bool
    {
        $uppercase = preg_match('@[A-Z]@', $value);
        $lowercase = preg_match('@[a-z]@', $value);
        $number    = preg_match('@[0-9]@', $value);
        $specialChars = preg_match('@[^\w]@', $value);

        return !(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8);
    }

    public function __toString(): string
    {
        return '% should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
    }
}