<?php

namespace PhpMvc\Validation;

use PhpMvc\Validation\Rules\Contract\Rule;

trait RulesResolver
{
    // receive string like Between:2,3|Required returns array of rules as [Required,Between([2,3])]
    public static function rulesStringSplitter(string $rulesString): array
    {
        $rules = [];
        $fieldRules = explode('|', trim($rulesString, "|"));
        foreach ($fieldRules as $rule) {
            if (str_contains($rule, ':')) {
                $rules [] = static::getRuleFromString($rule);
                continue;
            }
            $rules [] = RulesMap::getRule($rule);
        }
        return $rules;
    }

    // receive portion like Between:3,5 returns class name of Between and parameters Sent as array
    public static function getRuleFromString(string $ruleString): Rule
    {
        return RulesMap::getRule(($exploded = explode(':', $ruleString))[0], explode(',', end($exploded)));
    }

}