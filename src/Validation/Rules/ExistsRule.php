<?php

namespace Trinto\Validation\Rules;

use Trinto\Validation\Rules\Contract\Rule;

class ExistsRule implements Rule
{
    protected $table;

    protected $column;

    public function __construct($table, $column)
    {
        $this->table = $table;
        $this->column = $column;
    }

    public function apply($field, $value, $data)
    {
        return (app()->db->raw("SELECT * FROM {$this->table} WHERE {$this->column} = ?", [$value]));
    }

    public function __toString()
    {
        return '%s must be exists';
    }
}
