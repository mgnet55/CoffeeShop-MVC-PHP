<?php

namespace PhpMvc\Validation\Rules;

class MaxRule implements Contract\Rule
{

    protected int $max;

    public function __construct(int $max)
    {
        $this->max = $max;
    }

    public function apply($field, $value, $data): bool
    {
        return strlen($value) <= $this->max;
    }

    public function __toString(): string
    {
        return "% max length is {$this->max}";
    }
}