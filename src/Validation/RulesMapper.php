<?php

namespace Trinto\Validation;

use Trinto\Validation\Rules\MaxRule;
use Trinto\Validation\Rules\BetweenRule;
use Trinto\Validation\Rules\RequiredRule;
use Trinto\Validation\Rules\AlphaNumericalRule;
use Trinto\Validation\Rules\ConfirmedRule;
use Trinto\Validation\Rules\EmailRule;
use Trinto\Validation\Rules\ExistsRule;
use Trinto\Validation\Rules\UniqueRule;

trait RulesMapper
{
    protected static array $map = [
        'required' => RequiredRule::class,
        'alnum' => AlphaNumericalRule::class,
        'max' => MaxRule::class,
        'between' => BetweenRule::class,
        'email' => EmailRule::class,
        'confirmed' => ConfirmedRule::class,
        'unique' => UniqueRule::class,
        'exists' => ExistsRule::class,
    ];

    public static function resolve(string $rule, $options)
    {
        return new static::$map[$rule](...$options);
    }
}