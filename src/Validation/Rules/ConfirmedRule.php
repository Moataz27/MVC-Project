<?php

namespace Trinto\Validation\Rules;

use Trinto\Support\Arr;
use Trinto\Validation\Rules\Contract\Rule;

class ConfirmedRule implements Rule
{
    public function apply($field, $value, $data)
    {
        return (Arr::exists($data, $field . '_confirmation')) ? ($value === $data[$field . '_confirmation']) : false;
    }

    public function __toString()
    {
        return '%s must match with %s confirmation';
    }
    
}