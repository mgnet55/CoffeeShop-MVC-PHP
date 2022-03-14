<?php

namespace PhpMvc\Validation;

use PhpMvc\Validation\Rules\AlphanumericRule;
use PhpMvc\Validation\Rules\BetweenRule;
use PhpMvc\Validation\Rules\CharsOnly;
use PhpMvc\Validation\Rules\ConfirmRule;
use PhpMvc\Validation\Rules\Contract\Rule;
use PhpMvc\Validation\Rules\EmailRule;
use PhpMvc\Validation\Rules\MaxRule;
use PhpMvc\Validation\Rules\MinRule;
use PhpMvc\Validation\Rules\Numeric;
use PhpMvc\Validation\Rules\RequiredRule;
use PhpMvc\Validation\Rules\StrongRule;

trait RulesMap
{
    protected static array $map =[
        'required' => RequiredRule::class,
        'alphanumeric' => AlphanumericRule::class,
        'maxlength' => MaxRule::class,
        'between' => BetweenRule::class,
        'email' => EmailRule::class,
        'confirmed' => ConfirmRule::class,
        'numeric' => Numeric::class,
        'minlength' => MinRule::class,
        'password' => StrongRule::class,
        'chars' =>CharsOnly::class,
    ];

    public static function getRule(string $ruleName, array $params=[]):Rule{
        return new static::$map[$ruleName](...$params);
    }
}