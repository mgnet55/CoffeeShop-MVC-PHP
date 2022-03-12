<?php

namespace PhpMvc\Validation\Rules\Contract;

interface Rule
{
    public function apply($field,$value,$data):bool;
    public function __toString():string;
}