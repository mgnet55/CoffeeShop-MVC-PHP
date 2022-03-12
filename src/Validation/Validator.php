<?php

namespace PhpMvc\Validation;

use PhpMvc\Validation\Rules\ConfirmRule;
use PhpMvc\Validation\Rules\Contract\Rule;


class Validator
{
    protected array $data;
    protected array $rules;
    protected ErrorBag $errorBag;
    protected array $aliases;

    // validate invoking
    protected function makeValidators(): void
    {
        foreach ($this->rules as $field => $fieldRules) {
            if (is_string($fieldRules)) {
                $fieldRules = trim($fieldRules, "|");
                if ($fieldRules) {
                    $this->applyRules($field, $fieldRules);
                }
            }
        }
    }

    protected function applyRules($field, string|array $rules): void
    {
        if (is_array($rules)) {
            $rules = implode('|', $rules);
        }
        $splittedRules = RulesResolver::rulesStringSplitter($rules);
        foreach ($splittedRules as $rule) {
            if (!$rule->apply($field,$this->getFieldValue($field), $this->data)) {
                $this->errorBag->add($field, Message::generate($rule, $this->getAlias($field)));
                break;
            }
        }
    }

    public function validate($data): void
    {
        $this->data = $data;
        $this->errorBag = new ErrorBag;
        $this->makeValidators();
    }

    public function setRules(array $rules): void
    {
        $this->rules = $rules;
    }

    public function getFieldValue($field)
    {
        return $this->data[$field] ?? null;
    }

    public function isValid(): bool
    {
        return empty($this->getErrors());
    }

    public function getErrors($key = null)
    {
        var_dump($key);
        return $key ? $this->errorBag->errors[$key] : $this->errorBag->errors;
    }

    protected function getAlias($field)
    {
        return $this->aliases[$field] ?? $field;
    }

    public function setAlias($field, $alias)
    {
        $this->aliases[$field] = $alias;
    }

    public function setAliases(array $aliases)
    {
        //foreach($aliases as $field=>$alias){
        //  $this->aliases[$field] = $alias;
        //}
        $this->aliases = $aliases;
    }

}