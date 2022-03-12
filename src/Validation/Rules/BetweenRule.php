<?php

namespace PhpMvc\Validation\Rules;

class BetweenRule implements Contract\Rule
{

    protected int $min;
    protected int $max;

    public function __construct(int $min, int $max)
    {
        $this->min = $min;
        $this->max = $max;
    }

    public function apply($field,$value,$data):bool
    {
        return ($this->max >= strlen($value) && strlen($value)  >= $this->min);
    }

    public function __toString(): string
    {
        return '% length must be between '.$this->min .' and ' . $this->max. 'characters';
    }
}