<?php

namespace PhpMvc\Validation;

class Message
{
    public static function generate($rule,$field):string
    {
        return str_replace('%',$field,$rule);
    }
}