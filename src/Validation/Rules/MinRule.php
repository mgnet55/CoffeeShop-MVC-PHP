<?php

namespace PhpMvc\Validation\Rules;

class MinRule implements Contract\Rule
{

    protected int $min;

    public function __construct(int $min)
    {
        $this->min = $min;
    }

    public function apply($field, $value, $data): bool
    {
        return strlen($value) >= $this->min;
    }

    public function __toString(): string
    {
        return "% minimum length is {$this->min}";
    }
}